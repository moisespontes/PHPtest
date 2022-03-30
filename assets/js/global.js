const baseurl = 'http://www.phptest.com.br'
const zipcode = document.querySelector("#cep")
const search = document.querySelector("#btn-search")

/** Função para exibir alerts */
function alert(type, message) {
    let alertDiv = document.querySelector('#alert')
    let alert = `<div class="alert alert-${type} alert-dismissible p-2" role="alert">${message} <button type="button" class="btn-close p-2 m-1" data-bs-dismiss="alert" aria-label="Close"></button></div>`
    alertDiv.innerHTML = alert

    setTimeout(() => {
        let el = document.querySelector('.alert')
        el.style.display = 'none'

    }, 2000)
}

/** Converte o xml em json */
const xmlToJson = xml => {
    var obj = {};
    if (xml.children.length > 0) {
        for (var i = 0; i < xml.children.length; i++) {
            var item = xml.children.item(i);
            var nodeName = item.nodeName;

            if (typeof (obj[nodeName]) == "undefined") {
                obj[nodeName] = xmlToJson(item);
            } else {
                if (typeof (obj[nodeName].push) == "undefined") {
                    var old = obj[nodeName];

                    obj[nodeName] = [];
                    obj[nodeName].push(old);
                }
                obj[nodeName].push(xmlToJson(item));
            }
        }
    } else {
        obj = xml.textContent;
    }
    return obj;
}

/** Exibe os datdo no htnl */
const showAddress = data => {
    for (item in data) {
        if (document.querySelector(`.${item}`)) {
            document.querySelector(`.${item}`).innerText = data[item]
        }
    }
}

/** Realiza o cadastro do cep no db */
const createCep = data => {
    let dataJson = xmlToJson(data);
    let address = dataJson.xmlcep
    if (address.hasOwnProperty('erro')) {
        alert('danger', 'Cep não foi encontrado')
        return;
    }

    let formData = new FormData();
    formData.append('cep', address.cep);
    formData.append('logradouro', address.logradouro);
    formData.append('bairro', address.bairro);
    formData.append('localidade', address.localidade);
    formData.append('uf', address.uf);

    let init = {
        method: 'POST',
        body: formData
    }

    fetch(`${baseurl}/home/create-cep/`, init).then((response) => {
        if (!response.ok) throw new Error("Error " + response.status);
        return response.json()
    }).then(res => {
        if (res.result) {
            showAddress(res.data);
            alert("success", "Cep encontrado")
        } else {
            alert('danger', res.message)
        }
    }).catch(error => {
        alert('danger', 'Erro ao buscar cep, tente mais tarde.')
    })
}

/** Busca os dados na api do Viacep */
const getCepApi = cep => {

    let request = new Request(`https://viacep.com.br/ws/${cep}/xml/`, {
        method: 'GET',
        mode: 'cors',
        cache: 'default',
    })

    fetch(request).then((response) => {
        response.text()
            .then(xml => (new DOMParser()).parseFromString(xml, 'text/xml'))
            .then(data => createCep(data))
    }).catch(error => {
        alert('danger', 'Erro ao buscar cep, tente mais tarde.')
    })
}

/** Captua o evento de click e verifica se existe o cep no db */
search.addEventListener("click", (e) => {
    e.preventDefault();

    let cep = zipcode.value.replace('-', '')
    if (cep.length <= 0) {
        alert('danger', "Informe um Cep.")
        return
    }

    let request = new Request(`${baseurl}/home/get-cep/${cep}`, {
        method: 'GET'
    });

    fetch(request).then((response) => {
        if (!response.ok) throw new Error("Erro ao consultar, tente mais tarde");
        return response.json()
    }).then(response => {
        if (response.result) {
            showAddress(response.data)
            alert("success", "Cep encontrado")
            return
        }
        if (response.validate) {
            getCepApi(cep)
            return
        }
        alert('danger', 'Cep inválido.')
    }).catch(error => {
        alert('danger', 'Erro ao buscar cep, tente mais tarde.')
    });
})