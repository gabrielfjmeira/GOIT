//Validação do Formulário de Login
function formLoginOnSubmit(){
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');

    let reEmail = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/;   
    let reSenha= /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;          
                                  
    if (!reEmail.test(txtEmail.value)) {
        alert('Digite um Email válido!');
        txtEmail.focus();
        return false;
    }            
    
    if (txtSenha.value.length < 8 || txtSenha.value.length > 20){   
        txtSenha.setCustomValidity("Senha deve possuir no mínimo 8 e no máximo 20 caracteres!");
        txtSenha.reportValidity();        
        return false;
    }else{
        if (!reSenha.test(txtSenha.value)) {
            txtSenha.setCustomValidity("Sua senha deve possuir no mínimo: 1 símbolo, 1 letra maísucula, 1 letra minúscula e 1 dígito.");
            txtSenha.reportValidity();
            return false;
        }else{
            txtSenha.setCustomValidity("");
        }
    }               
    
    return true;
};


//Verificações do Cadastro de Lojista
function formCadastroLojistaOnSubmit(){
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

    let reEmail = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/;   
    let reSenha= /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;     
                                     
    if (!reEmail.test(txtEmail.value)) {
        txtEmail.setCustomValidity("Digite um E-Mail válido!");
        txtEmail.reportValidity();
        return false;
    }else{
        txtEmail.setCustomValidity("");
    }                       
    
    if (txtSenha.value.length < 8 || txtSenha.value.length > 20){   
        txtSenha.setCustomValidity("Senha deve possuir no mínimo 8 e no máximo 20 caracteres!");
        txtSenha.reportValidity();        
        return false;
    }else{
        if (!reSenha.test(txtSenha.value)) {
            txtSenha.setCustomValidity("Sua senha deve possuir no mínimo: 1 símbolo, 1 letra maísucula, 1 letra minúscula e 1 dígito.");
            txtSenha.reportValidity();
            return false;
        }else{
            txtSenha.setCustomValidity("");
        }
    }
    
    if (txtSenha.value != txtSenhaConfirmada.value) {
        txtSenhaConfirmada.setCustomValidity("Senhas diferentes!");
        txtSenhaConfirmada.reportValidity();
        return false;
    } else {
        txtSenhaConfirmada.setCustomValidity("");                    
    }
    
    return true;
}

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

//Função de Marcara para CNPJ
function MascaraParaCNPJ(valorDoTextBox) {
    if (valorDoTextBox.length <= 14) {  

        //Coloca ponto entre o segundo e o terceiro dígitos
        valorDoTextBox = valorDoTextBox.replace(/^(\d{2})(\d)/, "$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        valorDoTextBox = valorDoTextBox.replace(/^(\d{2})\.(\d{3})(\d)/, "$1 $2 $3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        valorDoTextBox = valorDoTextBox.replace(/\.(\d{3})(\d)/, ".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        valorDoTextBox = valorDoTextBox.replace(/(\d{4})(\d)/, "$1-$2") 
    } 
    return valorDoTextBox
}