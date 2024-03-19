<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';


if (isset($_POST['submit'])) {

    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $celular = $_POST['phone'];
    $mensaje = $_POST['message'];

    $errors = array();

    if (empty($nombre)) {
        $errors[] = 'El campo nombre es obligatorio';
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Ingrese un correo valido';
    }
    if (empty($celular)) {
        $errors[] = 'El campo celular es obligatorio';
    }
    if (empty($mensaje)) {
        $errors[] = 'El campo mensaje es obligatorio';
    }

    if (count($errors) == 0) {
        $msj = "De: $nombre <a href='mailto: $correo'>$correo</a><br>";
        $msj .= "Asunto: Informacion sobre los servicios <br><br>";
        $msj .= "Cuerpo del mensaje:";
        $msj .= '<p>' . $mensaje . '</p>';

        echo $msj;

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'LinkDelHost';
            $mail->SMTPAuth = true;
            $mail->Username = 'smasistemas@sanchezmyasociados.com';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('smasistemas@sanchezmyasociados.com', 'Contacto');
            $mail->addAddress('soportejym@sanchezmyasociados.com', 'Contacto CDP');

            $mail->isHTML(true);
            $mail->Subject = 'Formulario de contacto';
            $mail->Body = $msj;

            $mail->send();

            $respuesta = 'Correo enviado';
        } catch (Exception $e) {
            $respuesta = 'Mensaje ' . $mail->ErrorInfo;
        }
    }
}
?>

<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" name="name" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />

                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" name="email" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />

                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" name="phone" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" name="message" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                    </div>
                </div>
            </div>

            <!-- Confirmation message-->

            <?php if (isset($respuesta)) { ?>
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">
                            Form submission successful!
                            <?php echo $respuesta; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" name ="submit" type="submit">Send Message</button></div>
        </form>
    </div>
</section>