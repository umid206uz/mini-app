<?php

namespace frontend\controllers;

use common\models\Cart;
use common\models\Category;
use common\models\Product;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\web\ErrorAction;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'add'],
                'rules' => [
                    [
                        'actions' => ['signup', 'add', 'cart'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'add', 'cart'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param $user_id
     * @return mixed
     */
    public function actionIndex($user_id)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $session->set('user_id', $user_id);
        $categories = Category::find()->all();
        $products = Product::find()->all();
        return $this->render('index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function actionProduct($id): string
    {
        $product = Product::findOne($id);
        return $this->renderAjax('product', [
            'product' => $product
        ]);
    }

    public function actionCart(): string
    {
        $user_id = Yii::$app->session->get('user_id');
        $cart = Cart::find()->where(['user_id' => $user_id])->all();
        return $this->render('cart', [
            'cart' => $cart
        ]);
    }

    public function actionAdd(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $product_id = Yii::$app->request->get('product_id');
        $user_id = Yii::$app->session->get('user_id');
        $quantity = (int) Yii::$app->request->get('quantity',1);

        if (!$product_id || $quantity < 1) {
            return ['success' => false, 'error' => 'Noto‘g‘ri maʼlumotlar kiritildi.'];
        }

        $product = Product::findOne($product_id);
        if (!$product) {
            return ['success' => false, 'error' => 'Mahsulot topilmadi.'];
        }

        if (!$user_id) {
            return ['success' => false, 'error' => 'Foydalanuvchi aniqlanmadi.'];
        }

        $cartItem = Cart::findOne(['user_id' => $user_id, 'product_id' => $product_id]);
        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            $cartItem = new Cart([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product->price,
                'user_id' => $user_id,
                'status' => Cart::STATUS_ACTIVE,
            ]);
        }

        if ($cartItem->save()) {
            $cartCount = Cart::find()->where(['user_id' => $user_id])->count();
            return [
                'success' => true,
                'count' => $cartCount,
                'message' => 'Mahsulot savatchaga qo‘shildi.'
            ];
        }

        return [
            'success' => false,
            'error' => 'Saqlashda xatolik.',
            'details' => $cartItem->getErrors(),
        ];
    }



    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
