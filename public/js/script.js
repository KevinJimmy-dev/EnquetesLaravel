function newOption(){
    let div = document.querySelector('#options');

    let label = document.createElement('label');
    let input = document.createElement('input');

    label.setAttribute('for', 'title');
    label.setAttribute('class', 'form-label');
    label.innerHTML = 'Nova Opção';

    input.setAttribute('type', 'text');
    input.setAttribute('name', 'title[]');
    input.setAttribute('class', 'form-control');
    input.setAttribute('id', 'title[]');
    input.setAttribute('minlength', '1');
    input.setAttribute('maxlength', '100');
    input.setAttribute('required', 'required');

    div.appendChild(label);
    div.appendChild(input);
}