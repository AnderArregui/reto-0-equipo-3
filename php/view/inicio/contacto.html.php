<div class="general">
    <div class="container">
        <h2 class="titulo">Contacto</h2>
        <div class="contacto">

            /* Estamos usando un servidor para enviar formularios, cuando enviamos un formulario manda un correo a el asociado "En este caso en el de egoitz" para saber quien quiere contactar con nosotros.*/

            <form action="https://formsubmit.co/4c859de0c84b56f333f92b3191ccfa5b" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="asunto">Asunto:</label>
                <input type="text" name="asunto" id="asunto" required>
                <label for="mensaje">Mensaje:</label>
                <textarea name="mensaje" id="mensaje"></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>
        
    </div>
</div>