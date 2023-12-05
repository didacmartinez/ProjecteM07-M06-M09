// Load our customized validationjs library
import Validator from '../validator'


// Submit form ONLY when validation is OK
const form = document.getElementById("create-file-form")


if (form) {
   form.addEventListener("submit", function( event ) {
       // Reset errors messages
       // [...]
       // Get form inputs values
       let data = {
           "upload": document.getElementsByName("upload")[0].value,
       }
       let rules = {
        "upload": "required",
    }
    // Create validation
    let validation = new Validator(data,rules)
    // Validate fields
    if (validation.passes()) {
        // Allow submit form (do nothing)
        console.log("Validation OK")
    } else {
        // Get error messages
        let errors = validation.errors.all()
        console.log(errors)
        // Show error messages
        for(let inputName in errors) {          
            let error = errors[inputName]
            console.log("[ERROR] " + error)
            // [...]
        }
        // Avoid submit
        event.preventDefault()
        return false
    }
    function handleSubmit() {
        // Recoge los datos del formulario
        const formData = {
          // ... recoge los datos del formulario
        };
      
        // Define las reglas de validación para los datos del formulario (ajústalas según tus necesidades)
        const rules = {
          title: 'required|string|max:255',
          content: 'required|string',
          // ... otras reglas de validación
        };
      
        // Configura el validador con las reglas y los datos
        const validation = new Validator(formData, rules);
      
        // Realiza la validación
        if (validation.passes()) {
          // Los datos son válidos, puedes enviar el formulario o realizar otras acciones
          console.log('Datos válidos, enviar formulario...');
        } else {
          // Los datos no son válidos, muestra errores al usuario
          console.log('Datos no válidos, muestra errores al usuario:', validation.errors.all());
        }
      }
    
})
}
