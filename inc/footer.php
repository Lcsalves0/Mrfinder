<div class="content-block" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Mr. Finder</h2>
          <p>Sou especialista em procura de instituições que faz crescer o seu negócio no mundo online.</p>
          <p>A minha missão é facilitar o processo de comunicação entre cliente e entidade, dispondo de várias opções, que podem oscilar entre a presença online simples à gestão total dos dados da sua empresa. </p>
        </div>
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Conte-me segredos...</h2>
          <form id="contactForm" action="inc/insertRegistos.php" method="post" 
            data-bv-message="This value is not valid"
            data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
            data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
            data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            <div class="form-group">
              <input type="email" class="input_style full" name="email" placeholder="Diga-me o seu email" required data-bv-notempty-message="Email obrigatório!" style="margin-left:0;">
            </div>
            <div class="form-group">
              <input type="text" class="input_style full" name="assunto" placeholder="Diga-me o seu assunto" required data-bv-notempty-message="Assunto obrigatório!" style="margin-left:0;"/>
            </div>
            <div class="form-group">
              <textarea class="input_style full" name="descricao" placeholder="Diga-me o que pretende..." name="bio" rows="5" data-bv-stringlength data-bv-stringlength-max="500" data-bv-stringlength-message="Mensagem não pode ultrapassar 500 carateres!" style="margin-left:0px;" required data-bv-notempty-message="Mensagem obrigatório!"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" name="enviarContato" class="text-center btn btn-o-white" >Enviar</button>
            </div>
          </form>
        </div>
        <div class="col-sm-4 blog-post">
          <h2 class="footer-block">Contactos</h2>
          <ul>
            <li class="address-sub"><i class="fa fa-map-marker"></i>Endereço do Escritório:</li>
            <p> Em todo o lado... </p>
            <li class="address-sub"><i class="fa fa-phone"></i>Phone</li>
            <p> Local: 1-800-123-hello<br>
              Mobile: 1-800-123-hello </p>
            <li class="address-sub"><i class="fa fa-envelope-o"></i>Endereço de Email</li>
            <p> <a href="mailto:mrfinder@hotmail.com">mrfinder@hotmail.com</a><br>
              <a href="www.mrfinder.pt">www.mrfinder.pt</a> </p>
          </ul>
          <div class="social"> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-instagram"></i></a> <a href="#"><i class="fa fa-pinterest-p"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-skype"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
<div class="content-block footer-bottom" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-5">&copy; Copyright 2015</div>
      </div>
    </div>
  </div>
 
<!--- Validator -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script>
$('#contactForm').bootstrapValidator();
</script>
<!------------>
