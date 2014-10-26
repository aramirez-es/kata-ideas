Lo primero que me viene a la mente es que al ser un repo ya existente, el concepto de Usuario ya debe estar modelado 
de alguna forma, seguramente como clase. No obstante, decido por la vía más purista y en principio, el usuarios
solo será un string en forma de email.

El texto "These ideas will be persisted to a database." me hace dudar de la primera implementación a realizar. En 
primera instancia estaba pensando en crear un repositorio de ideas que recibiendo un objeto "idea" lo almacenara
en un array, pero esa me hace pensarlo más en profundida. No obtante vuelvo a decidir empezar de la forma más simple
posible.


Después del primer commit donde se permite añadir y obtener ideas, decido refactorizar para extraer idea como clase,
ya que en principio es un array pero representa un conjunto de datos con cohesión.
    - La propiedad "id" prefiero recibirla como parámetro en el constructor en vez de delegar la construcción del mismo
    a la propia clase "Idea".
    
    - Con la propiedad "date" estoy dudando si permitir recibirla o autogenerarla. 
