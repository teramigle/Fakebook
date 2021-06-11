document.querySelectorAll('.edit-button').forEach(item => {
    item.addEventListener('click', event => {
      let content = item.parentElement.parentElement.parentElement.getElementsByTagName('div')[1].getElementsByTagName('p')[0];
      let input = item.parentElement.parentElement.parentElement.getElementsByTagName('div')[1].getElementsByTagName('input')[0];
      console.log(input);
      content.setAttribute('contenteditable', 'true');
    //   content.classList.add('border');
    //   content.classList.add('border-dark');
    //   item.value='Išsaugoti';
    //   item.setAttribute('name', 'save');
      item.setAttribute('type', 'hidden');
      let save = document.createElement('input');
      save.setAttribute('type', 'submit');
      save.setAttribute('name', 'save');
      save.setAttribute('form', 'edit-post');
      save.classList.add('btn');
      save.value="Išsaugoti";
      save.classList.add('btn-outline-secondary');
      save.classList.add('me-2');
      item.parentElement.appendChild(save);
      
      
    //   content.outerHTML = content.outerHTML.replace(/p/g,"textarea");
    //   let form = document.createElement('form');
    //   item.parentElement.parentElement.parentElement.getElementsByTagName('div')[1].appendChild(form);
    //   form.appendChild(content.outerHTML);

    // `element` is the element you want to wrap
    let parent = content.parentNode;
    let form = document.createElement('form');
    form.setAttribute('method', 'POST');
      form.setAttribute('action', 'edit-post.php');
      form.setAttribute('id', 'edit-post');
      form.classList.add('flex-fill');

    // set the wrapper as child (instead of the element)
    parent.replaceChild(form, content);
    parent.replaceChild(form, input);
    // set element as child of wrapper
    form.appendChild(content);
    form.appendChild(input);
    // content.outerHTML = content.outerHTML.replace(/p/g,"textarea");
    let textarea = document.createElement('textarea');
    textarea.innerHTML = content.innerHTML;
    content.parentNode.replaceChild(textarea, content);
    textarea.classList.add('mx-3');
    textarea.classList.add('w-100');
    textarea.setAttribute('name', 'content');
    textarea.setAttribute('rows', '5');
    textarea.setAttribute('style', 'line-break:anywhere;');
    // content.setAttribute('rows', '10');


    // let id = document.createElement('input');
    // id.setAttribute('type', 'hidden');
    })
  })



