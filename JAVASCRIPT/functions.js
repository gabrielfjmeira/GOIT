//Validação do Formulário de Login
function formLoginOnSubmit(){
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');

    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    let reSenha= /(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;          
                                  
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
    
    return true;
};

//Validação do Cadastro do Praticante
function formCadastroPraticanteOnSubmit(){   
    let txtNome = document.getElementById('txtNome');
    let txtApelido = document.getElementById('txtApelido');
    let dataNascimento = document.getElementById('dataNascimento');
    let dtDOB = new Date(dataNascimento);
    let dtCurrent = new Date();                
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; 
    let reSenha=  /(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;         
            
    if(txtNome < 8 || txtNome > 100){
        txtNome.setCustomValidity("Nome deve possuir no mínimo 8 e no máximo 100 caracteres");
        txtNome.reportValidity();
        return false;
    }else{
        txtNome.setCustomValidity("");
    }

    if(txtApelido < 8 || txtNome > 30){
        txtApelido.setCustomValidity("Apelido deve possuir no mínimo 8 e no máximo 100 caracteres");
        txtApelido.reportValidity();
        return false;
    }else{
        txtApelido.setCustomValidity("");
    }

    if (dtDOB - dtCurrent < 0){                    
        dataNascimento.setCustomValidity("Data de Nascimento inválida!");
        dataNascimento.reportValidity();
        return false;
    }else{
        dataNascimento.setCustomValidity("");
    }

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

//Validação do Cadastro do Instrutor
function formCadastroInstrutorOnSubmit(){   
    let txtNome = document.getElementById('txtNome');
    let txtApelido = document.getElementById('txtApelido');
    let dataNascimento = document.getElementById('dataNascimento');
    let dtDOB = new Date(dataNascimento);
    let dtCurrent = new Date();                
    let txtCadastur = document.getElementById('txtCadastur');
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; 
    let reSenha=  /(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;         
            
    if(txtNome < 8 || txtNome > 100){
        txtNome.setCustomValidity("Nome deve possuir no mínimo 8 e no máximo 100 caracteres");
        txtNome.reportValidity();
        return false;
    }else{
        txtNome.setCustomValidity("");
    }

    if(txtApelido < 8 || txtNome > 30){
        txtApelido.setCustomValidity("Apelido deve possuir no mínimo 8 e no máximo 100 caracteres");
        txtApelido.reportValidity();
        return false;
    }else{
        txtApelido.setCustomValidity("");
    }

    if (dtDOB - dtCurrent < 0){                    
        dataNascimento.setCustomValidity("Data de Nascimento inválida!");
        dataNascimento.reportValidity();
        return false;
    }else{
        dataNascimento.setCustomValidity("");
    }

    if (txtCadastur < 15 || txtCadastur > 15){
        txtCadastur.setCustomValidity("Cadastur deve possuir 15 caracteres.");
        txtCadastur.reportValidity();
        return false;
    }else{
        txtCadastur.setCustomValidity("");
    }

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

//Verificações do Cadastro de Lojista
function formCadastroLojistaOnSubmit(){
    let txtEmail = document.getElementById('txtEmail');
    let txtSenha = document.getElementById('txtSenha');
    let txtSenhaConfirmada = document.getElementById('txtSenhaConfirmada');

    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;   
    let reSenha= /(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;     
                                     
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

//Função de Mostrar/Ocultar Senha do Login
function mostrarSenhaLogin(){
    let txtSenha = document.getElementById('txtSenha');    
    
    if (txtSenha.type == "password"){
        txtSenha.type = "text";        
    } else {
        txtSenha.type = "password";       
    }
}

//Função da Inserção de um Novo Risco de Atividade
function formInsertRiscosAtividadesOnSubmit(){
    let txtDescricao = document.getElementById('txtDescricao');
    let nbrMinimo = document.getElementById('nbrMinimo').value;
    let nbrMaximo = document.getElementById('nbrMaximo').value;

    if (txtDescricao.value.length > 30){
        txtDescricao.setCustomValidity("Descrição não pode passar de 30 caracteres");
        txtDescricao.reportValidity();
        return false;
    }else{
        txtDescricao.setCustomValidity("");
    }

    if (nbrMinimo < 0 || nbrMinimo > 10){
        nbrMinimo.setCustomValidity("Valor mínimo deve estar entre 0-10");
        nbrMinimo.reportValidity();
        return false;
    }else{
        nbrMinimo.setCustomValidity("");
    }

    if (nbrMaximo < 0 || nbrMaximo > 10){
        nbrMaximo.setCustomValidity("Valor máximo deve estar entre 0-10");
        nbrMaximo.reportValidity();
        return false;
    }else{
        nbrMaximo.setCustomValidity("");
    }

    if (nbrMinimo > nbrMaximo){
        nbrMinimo.setCustomValidity("Valor mínimo deverá ser menor ou igual ao valor máximo");
        nbrMinimo.reportValidity();
        return false;
    }else if(nbrMaximo < nbrMinimo){
        nbrMinimo.setCustomValidity("Valor máximo deverá ser maior ou igual ao valor mínimo");
        nbrMinimo.reportValidity();
        return false;
    }else{
        nbrMinimo.setCustomValidity("");
        nbrMaximo.setCustomValidity("");
    }

    return true;
}

//Função da Alteração de um Risco de Atividade
function formAlterarRiscosAtividadesOnSubmit(){
    let txtDescricao = document.getElementById('txtDescricao');
    let nbrMinimo = document.getElementById('nbrMinimo').value;
    let nbrMaximo = document.getElementById('nbrMaximo').value;

    if (txtDescricao.value.length > 30){
        txtDescricao.setCustomValidity("Descrição não pode passar de 30 caracteres");
        txtDescricao.reportValidity();
        return false;
    }else{
        txtDescricao.setCustomValidity("");
    }

    if (nbrMinimo < 0 || nbrMinimo > 10){
        nbrMinimo.setCustomValidity("Valor mínimo deve estar entre 0-10");
        nbrMinimo.reportValidity();
        return false;
    }else{
        nbrMinimo.setCustomValidity("");
    }

    if (nbrMaximo < 0 || nbrMaximo > 10){
        nbrMaximo.setCustomValidity("Valor máximo deve estar entre 0-10");
        nbrMaximo.reportValidity();
        return false;
    }else{
        nbrMaximo.setCustomValidity("");
    }

    if (nbrMinimo > nbrMaximo){
        nbrMinimo.setCustomValidity("Valor mínimo deverá ser menor ou igual ao valor máximo");
        nbrMinimo.reportValidity();
        return false;
    }else if(nbrMaximo < nbrMinimo){
        nbrMinimo.setCustomValidity("Valor máximo deverá ser maior ou igual ao valor mínimo");
        nbrMinimo.reportValidity();
        return false;
    }else{
        nbrMinimo.setCustomValidity("");
        nbrMaximo.setCustomValidity("");
    }

    return true;
}

//Função da Inserção de um Novo Tipo de Usuário
function formInsertTiposUsuariosOnSubmit(){
    let txtDescricao = document.getElementById('txtDescricao');    

    if (txtDescricao.value.length > 13){
        txtDescricao.setCustomValidity("Descrição não pode passar de 13 caracteres");
        txtDescricao.reportValidity();
        return false;
    }else{
        txtDescricao.setCustomValidity("");
    }
    
    return true;
}

//Função da Alteração de um Tipo de Usuário
function formAlterarTiposUsuariosOnSubmit(){
    let txtDescricao = document.getElementById('txtDescricao');    

    if (txtDescricao.value.length > 13){
        txtDescricao.setCustomValidity("Descrição não pode passar de 13 caracteres");
        txtDescricao.reportValidity();
        return false;
    }else{
        txtDescricao.setCustomValidity("");
    }
    
    return true;
}