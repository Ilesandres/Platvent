
##para traer los productos con sus datos generales para mostrar

select producto.id, producto.img ,producto.descripcion, producto.unidadMedida, producto.stock,
producto.saldo ,producto.precioBase, estadoproducto.estado,producto.fechaRegistro,
producto.fechaActualizacion,producto.idUsuario
from producto
inner join estadoproducto on producto.estado=estadoproducto.idestadoProducto order by 1;

##traer datos para un usuario en especifico recomendable por id

select usuario.nombre, usuario.usuario, usuario.correo, rol.Rol,usuario.descripcion,usuario.telefono,
usuario.fecha_nacimiento, municipio.municipio, departamento.departamento
 from rol 
inner join usuario on usuario.idRol=rol.idRol
inner join municipio on municipio.idMunicipio=usuario.idMunicipio
inner join departamento on departamento.idDepartamento=municipio.idDepartamento

where usuario.idUsuario=1
;