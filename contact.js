var submit = document.getElementById("submit") 


submit.addEventListener("click", function(e){
var name = document.getElementById("name").value
var email = document.getElementById("email").value 
var message = document.getElementById("message").value 
    if (name.length < 2 || email.length < 6 || message.length < 10) {
        alert("Veuillez remplir correctement les champs")
        e.preventDefault()
    }
    else{
        alert("Merci de nous avoir écrit, vous recevrez une réponse dans un délai de 24h")
    }
})

