- Lo primero que hago es crear una especificación por la que un usuario debería ser capaz de votar.

- El primer problema que me encuentro es cómo dar por válida esa especificación: el usuario puede votar, pero, cómo compruebo que el voto fue correctamente procesado?
Para responder a esa pregunta, me creo un un método llamado "countVotesFor", quien recibe un ideaId y devuelve el número de votos registrados para esa idea.
La forma de almacenamiento no es más que otro array clave-valor, indexado por IdeaId y que contiene un array con los usuarios que han votado

- Añado un par de testcases más para reforzar la "spec": ideas que no han sido votadas deben devolver cero. Cuando tratas de obtener número de votos de una idea inexistente, devuelve un errror.

- Aplico algún refactoring necesario tanto en Ideas como en el test.

- En este momento creo que Ideas ya contiene más responsabilidades de las que debería, repasando:
-- Actúa como servicio para sugerir y obtener ideas.
-- Actúa como servicio para votar ideas.
-- Actúa como repositorio de ideas.
-- Actúa como repositorio de votos.
Así que voy a transformar "Ideas" en un servicio, extrayendo la responsabilidad de repositorio a otra clase.

Con esto, doy por finalizada la iteración 2.
