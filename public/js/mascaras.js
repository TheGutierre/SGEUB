/**
 * Created by Gutierre on 24/09/2017.
 */
function Mascara(o,f){

    v_obj=o

    v_fun=f

    setTimeout("execmascara()",1)

}



/*Função que Executa os objetos*/

function execmascara(){

    v_obj.value=v_fun(v_obj.value)

}

/*Função que permite apenas numeros*/

function Integer(v){

    return v.replace(/\D/g,"")

}


/*Função que padroniza CPF*/

function Cpf(v){

    v=v.replace(/\D/g,"")

    v=v.replace(/(\d{3})(\d)/,"$1.$2")

    v=v.replace(/(\d{3})(\d)/,"$1.$2")



    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    return v

}

function Matricula(v){

    v=v.replace(/\D/g,"")

    v=v.replace(/(\d{2})(\d)/,"$1.$2")

    v=v.replace(/(\d{1})(\d{5})/,"$1.$2")

    return v

}


/*Função que padroniza DATA*/

function Data(v){

    v=v.replace(/\D/g,"")

    v=v.replace(/(\d{2})(\d)/,"$1/$2")

    v=v.replace(/(\d{2})(\d)/,"$1/$2")

    return v

}
