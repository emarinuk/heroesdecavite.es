<?php
add_filter('gettext_with_context', function ($translated, $original, $context, $text_domain)
{
    if($context === 's2member-front' && $text_domain === 's2member')
    {
        if($original === 'Password (type this twice please)')
            $translated = 'Password (enter twice to confirm)';

        else if($original === 'Submit Form')
            $translated = 'Submit';

        else if($original === 'Username:')
            $translated = 'Nombre de usuario (puede ser tu correo electrónico):';

        else if($original === 'First Name')
            $translated = 'Nombre';

        else if($original === 'Last Name')
            $translated = 'Apellido(s)';

        else if($original === 'Password (please type it twice)')
            $translated = 'Contraseña (introdúcela dos veces)';




        else if($original === 'password strength indicator')
            $translated = 'indicador de la seguridad de la contraseña';

        else if($original === 'Username *')
            $translated = 'Nombre de usuario (puede ser tu dirección de correo electrónico) *';

        else if($original === 'Email Address *')
            $translated = 'Dirección de correo electrónico *';
    }
    return $translated; // Return final translation.
}, 10, 4);