<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\FormularioForm;
use kartik\mpdf\Pdf;
use Mpdf\Tag\P;

class SitioController extends Controller
{
    public function actionInicio(){

        $model=new FormularioForm;

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            $content = $this->renderPartial('_reportView',['model' => $model]);
        
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => [
                    // '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                    '@app/web/css/bootstrap.css',                  
                    '@app/web/css/site.css',                
                ],
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                 // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>['Krajee Report Header'], 
                    'SetFooter'=>['{PAGENO}'],
                
                ]
            ]);
            
            // return the pdf output as per the destination setting
            return $pdf->render(); 

        }
        
        return $this->render('formulario',['model'=>$model,'mensaje' => null]);

    }
    public function actionReport(FormularioForm $model) {
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportView',['model' => $model]);
        // aqui quedé $pdf->Image('../images/image_demo.jpg', 50, 50, 100, 150, '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9QVWdXAt1r5xRzSOyAaEO_XKnT5nJoMxf7w&usqp=CAU', '', true, 150);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => ['@web/css/site.css'],
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            '@app/web/css/bootstrap.css', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }


}


?>