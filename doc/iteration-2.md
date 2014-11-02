- Lo primero que hago es crear una especificación por la que un usuario debería ser capaz de votar.

- El primer problema que me encuentro es cómo dar por válida esa especificación: el usuario puede votar, pero, cómo compruebo que el voto fue correctamente procesado?
Para responder a esa pregunta, me creo un un método llamado "countVotesFor", quien recibe un ideaId y devuelve el número de votos registrados para esa idea.
La forma de almacenamiento no es más que otro array clave-valor, indexado por IdeaId y que contiene un array con los usuarios que han votado
