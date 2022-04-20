<?php include("template/cabecera.php");
include('admin/config/bd.php');
include('template/carrito.php');

?> 

<?php 

$correo=$_POST['email'];
if($_POST){

$total=0;
$SID=session_id();
    foreach($_SESSION['carrito'] as $indice=>$producto){
        $total=$total+($producto['precio']*$producto['cantidad']);
    }
    $sentenciaSQL=$conexion->prepare("INSERT INTO `pagos` 
    (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `Status`)
     VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");
    
     $sentenciaSQL->bindParam(':ClaveTransaccion',$SID);
     $sentenciaSQL->bindParam(':Correo',$correo);
     $sentenciaSQL->bindParam(':Total',$total);
     $sentenciaSQL->execute();

     $idVenta = $conexion ->lastInsertId(); 
     foreach($_SESSION['carrito'] as $indice=>$producto){
     
        $sentenciaSQL=$conexion->prepare ("INSERT INTO `detallepagos` (`id`, `idventa`, `idproducto`, `precio`, `cantidad`, `pagado`) VALUES (NULL, :idventa, :idproducto, :precio, :cantidad, '0');"); 

        $sentenciaSQL->bindParam(':idventa',$idVenta);
        $sentenciaSQL->bindParam(':idproducto',$producto['id']);
        $sentenciaSQL->bindParam(':precio',$producto['precio']);
        $sentenciaSQL->bindParam(':cantidad',$producto['cantidad']);
        $sentenciaSQL->execute();
    }

    //echo "<h3>".$total."</h3>";
}
?>

<div class="jumbotron">
    <h1 class="display-3">¡PASO FINAL!</h1>
    <p class="lead">Estas a punto de pagar con paypal la cantidad de: 
        <h4> $<?php echo number_format($total,2);?> MXN </h4>
    </p>
    <p>Los muebles llegaran a su domicilio en un lapso de 24 a 48hrs una vez procesado el pago.
        <strong>(Se descargara un recibo o clausula donde consta su pago anticipado) <br> Dudas o aclaraciones: ibarra90@gmail.com</strong>
    </p>
    <hr class="my-2">
    <p>Mas Información</p>

    <div class="container-fwm">
 
        <!-- icono facebook -->
    <svg  xmlns="http://www.w3.org/2000/svg"   width="26" height="26" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <a href="//www.facebook.com/carpinteria.britania.1" target="_blank">
         
          <path   d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/> 
    </svg>
       
          
     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <a href="https://api.whatsapp.com/send?phone=526182459059&text=¿Qué servicios ofrecen?" target="_blank">
     <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
     </svg>  

     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16"><a href="http://m.me/carpinteria.britania.1" target="_blank">
         <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
      </svg> 
      </div>
<br>
      <div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
       env: 'sanbox',
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'gold',
          layout: 'horizontal',
          label: 'paypal',
          
        },

       
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"MXN","value":'<?php echo $total;?>'}}]
            
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
           // window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        client: {
        sandbox: 'AZ1OkJilVmP7caXB10wtTm-en1MToabhcgAoPjwI0DPHKn0Xbf2t9yT2eBUF9AxRuSCfFwqdNBgMlcid',
        production: 'APKiNHykbcLt7PoiWc-ZVdLLpYvYAWRourvjjgF0usnfWSjtpYZL0PLk'
     },

     payment: function(data, actions){
return actions.payment.create({

payment:{

transactions:[
  {
  amount: {total: '<?php echo $total;?>', currency: 'MXN'},
  
          description: "compra de productos a muebles britania $ <?php echo number_format($total,2);?>",
          custom: "<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY);?>"
       }
      ]   
     }
    
  });
}, 

onAutorize: function(data, actions){
    return actions.payment.execute().then(function(){
  consol.log(data)
  
    });
}, 


        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>
    
</div>



<?php include("template/pie.php");?> 