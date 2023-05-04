//Seta a data máxima aceita na data de nascimento para a data atual
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //Janeiro é 0!
var yyyy = today.getFullYear();

if (dd < 10) {
dd = '0' + dd;
}

if (mm < 10) {
mm = '0' + mm;
} 
    
today = yyyy + '-' + mm + '-' + dd;
document.getElementById("dataNascimento").setAttribute("max", today);

//Função de Mostrar/Ocultar Senha
function mostrarSenha(){
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');
    
    if (txtSenha.type == "password"){
        txtSenha.type = "text";
        txtSenhaConfirmada.type = "text";
    } else {
        txtSenha.type = "password";
        txtSenhaConfirmada.type = "password";
    }              
}

//Função de Mostrar/Ocultar Senha do Login
function mostrarSenhaLogin(){
    let txtSenha = document.getElementById('txtSenha');    
    
    if (txtSenha.type == "password"){
        txtSenha.type = "text";        
    } else {
        txtSenha.type = "password";       
    }
}

//Validação do Cadastro do Praticante
function formCadastroPraticanteOnSubmit(){                   
    //Cria Variáveis
    let txtNome = document.getElementById('txtNome');
    let errorNome = document.getElementById('errorNome');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');      
    let errorSenhas = document.getElementById('errorSenhas');                                          
    
    if (txtNome.value.length > 100){
        txtNome.style.border = "1px solid #DB5A5A";
        errorNome.innerHTML = "Nome excede 100 caracteres!";
        txtNome.focus();
        return false;
    }else{
        errorNome.innerHTML = "";
    }

    if (txtSenha.value != txtSenhaConfirmada.value) {
        txtSenha.style.border = "1px solid #DB5A5A";
        txtSenhaConfirmada.style.border = "1px solid #DB5A5A";
        errorSenhas.innerHTML = "Senhas informadas não coincidem!";
        return false;
    }else{
        errorSenhas.value = "";
    }
    
    return true;
}

//Validação do Cadastro do Instrutor
function formCadastroInstrutorOnSubmit(){    
    //Cria Variáveis
    let txtNome = document.getElementById('txtNome');
    let errorNome = document.getElementById('errorNome');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');      
    let errorSenhas = document.getElementById('errorSenhas');                                          
                                                 
    if (txtNome.value.length > 100){
        txtNome.style.border = "1px solid #DB5A5A";
        errorNome.innerHTML = "Nome excede 100 caracteres!";
        txtNome.focus();
        return false;
    }else{
        errorNome.innerHTML = "";
    }

    if (txtSenha.value != txtSenhaConfirmada.value) {
        txtSenha.style.border = "1px solid #DB5A5A";
        txtSenhaConfirmada.style.border = "1px solid #DB5A5A";
        errorSenhas.innerHTML = "Senhas informadas não coincidem!";
        return false;
    }else{
        errorSenhas.value = "";
    }
    
    return true;
}    

//Verificações do Cadastro de Lojista
function formCadastroLojistaOnSubmit(){     
    //Cria Variáveis
    let txtRazaoSocial = document.getElementById('txtRazaoSocial');
    let errorRazaoSocial = document.getElementById('errorRazaoSocial');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');      
    let errorSenhas = document.getElementById('errorSenhas');   
    
    if (txtRazaoSocial.value.length > 100){
        txtRazaoSocial.style.border = "1px solid #DB5A5A";
        errorRazaoSocial.innerHTML = "Razão Social excede 100 caracteres!";
        txtRazaoSocial.focus();
        return false;
    }else{
        errorRazaoSocial.innerHTML = "";
    }
                                                 
    if (txtSenha.value != txtSenhaConfirmada.value) {
        txtSenha.style.border = "1px solid #DB5A5A";
        txtSenhaConfirmada.style.border = "1px solid #DB5A5A";
        errorSenhas.innerHTML = "Senhas informadas não coincidem!";
        return false;
    }else{
        errorSenhas.value = "";
    }
    
    return true;
}