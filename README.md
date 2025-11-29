-   [x] Pagos parciales o abonos
-   [x] La cuota es anual, se divide en dos, 50% abril 50% junio
-   [x] Artículos tener fotos, articulo tener pdf
-   [x] Mecanismo de pago de cuota (transferencia / efectivo)
-   [x] Exportar a Excel todos los listados.
-   [x] Cuota diferenciada por rango etario, socios bailarines
-   [x] Cuota diferenciada por vitalicios
-   [x] La cuota depende de rango etario
-   [x] clasificación de socio, bailarín, socio, inactivo
-   [x] Agregar campo sacramentos al usuario: Bautismo, Iniciación a la eucaristía y confirmación
-   [x] Ubicación en la fila (derecha / izquierda) (opcional) ángel
-   [x] Sexo (femenino/masculino)
-   [x] Antecedentes de salud
-   [x] Dirección, comuna y ciudad
-   [x] Redes sociales (Facebook o Instagram)
-   [x] Foto del socio
-   [x] Actas del sistema
-   [x] Enviar comprobante a correo de usuario
-   [x] Boton para generar cuotas
-   [x] Incorporar en pago, quien recibe el dinero
-   [x] Crear cuota para ocación particular
-   [x] Cambiar el login a run
-   [x] Permitir poner un correo repetido
-   [x] Agregar Anotaciones a usuarios
-   [x] Crear cuota especial a ciertos usuarios.
-   [x] Crear widget de cuotas vencidas.
-   [x] Marcar actas como publicas / privadas
-   [x] Tipo de acta
-   [x] Auditoría.
-   [x] Soft deletes.
-   [x] Link a archivos del sociedad
-   [x] Ficha en pdf
-   [x] Widget de finanzas / estadísticas de finanzas
-   [x] Certificado de inscripción
-   [x] Acceso a sus comprobantes
-   [x] Firma certificado
-   [x] Dos finanzas dobles (que no se mezclan)
-   [ ] Pasado 30 días no permitir borrar.
-   [ ] Prespuesto
-   [ ] Ranking de asistencia
-   [ ] Dependiente hijos
-   [ ] Cambio de tipo de miembro, de bailarín a socio, actualizar valor cuota

-   [x] Actas públicas
-   [x] Envíe la noticia por correo
-   [x] Revisar inscripción
-   [x] Ver Noticia
-   [x] Crear cuota anual seleccionando el año
-   [x] Agregar a todos password por defecto
-   [x] Agregar segundo firmante en el certificado
-   [x] Actas solo para caporales
-   [x] Quitar asistencia de publico

-   [x] Cambio de clave obligatorio, si tiene clave reseteada obliga a cambiar clave
-   [x] No permitir iniciar sesión a los inactivos o suspendidos
-   [x] Arreglar Filtro de concepto en cuotas
-   [x] Reiniciar contadores de pedro
-   [x] Arreglar certificado (ver opción de plantilla)
-   [x] Esconder asistencia de los socios
-   [x] Resumen de asistencias en un periodo de tiempo
-   [ ] Envío de certificado al correo del socio
-   [ ] Enviar clave al correo
-   [ ] Justificados (en asistencia)
-   [ ] Exportar asistencia a excel

Octubre a Octubre
Revisar exportación

-

Panel del socio

-   Noticias, Actas, Ficha, Cuotas

-   Actualizar claves masivamente
    DB::statement("UPDATE users SET run = TRIM(run)");
    User::all()->each(fn($user) => $user->update(['password' => Hash::make(mb_substr(trim($user->run), 0, -2))]));
