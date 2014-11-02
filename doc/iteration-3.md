Para que un usuario no pueda votar su propia idea, el sistema ha de conocer quién está en ese momento logado. Por otro lado, creo que quien debe tomar la decisión de permitir votar o no ha de ser el propio Servicio, así que lo que voy a hacer es:
- En principio, el servicio obtendrá en el usuario logado en mediante el constructor.
-- Para este paso, voy a crear un VO representando el usuario por medio de su emai. Por lo pronto me es suficiente con esto.
- Se han de cambiar las referencias en Votos e Ideas para que reciban un UserId en vez del email en plano.
- En este paso me pregunto si tiene sentido un VO representando el Voto. Ahí lo dejo por ahora.
- En el caso de uso de votación, habrá que hacer la comprobación pertinente.
