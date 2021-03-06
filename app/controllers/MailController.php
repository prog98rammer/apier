<?php 

/*==========================================================
 *                                                         *
 *             This is the demo Controller                 *
 *              You Can find all what you                  *
 *               Need in this contoller                    *
 *                                                         *
 *                                                         *
 *                                                         *
 *                                                         *
 *========================================================*/

namespace App\Controllers;

use App\Controller as BaseController;
use KAD; // the Query Builder
use Rakit\Validation\Validator;
use Carbon\Carbon;


use App\Http\Requester;

class MailController extends BaseController
{

    public function index()
    {
        $user = $this->toJson(KAD::table('users')->where('id', '=', 1)->get());

        try {
            $this->mail->addAddress('prog.khalid.mohammad@gmail.com', 'Khalid');     // Add a recipient

            //Content
            $this->mail->isHTML(true);       // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'السلام عليكم';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        }
    }

    public function testMail()
    {
        // dummy data
        $data = [
            'name' => 'khalid',
            'email' => 'test2@email.com'
        ];

        // this mail will render a view with variables you sent.
       $html = getMailContent('thanksForRegisteration', compact('data'));

       return $html;

        try {
            $this->mail->addAddress('prog.khalid.mohammad@gmail.com', 'Khalid');     // Add a recipient

            //Content
            $this->mail->isHTML(true);       // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = $html;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            
            return $this->toJson([
                'status' => 'Success',
                'message' => 'Mail has been sent successfully',
                'status_code' => 200
            ]);
            
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        }
    }


}
