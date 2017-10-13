<p>Tienes un nuevo mail generado desde el formulario de contacto de la web:</p>

<strong>Nombre : {{ $request->form_name }}</strong><br/>
<strong>Teléfono : {{ $request->form_phone }}</strong><br/>
<strong>Dirección de e-mail : {{ $request->form_mail }}</strong><br/>
<strong>Asunto : {{ $request->form_subject }}</strong><br/>
<strong>Contenido :</strong><br/>
<div style="border: 1px solid grey; padding:5px; margin-top:10px;">
    {!! nl2br(e($request->form_body)) !!}
</div>