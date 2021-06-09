document.querySelectorAll('.comment-button').forEach(item => {
    item.addEventListener('click', event => {
      let post = item.parentElement.parentElement.parentElement.parentElement.parentElement;
      console.log(post);
      let comment = post.children[1];
      console.log(comment);
      comment.classList.remove('d-none');
    
//       let close = document.getElementsByClassName('close')[0];
// console.log(close);
//         close.addEventListener('click', e => {
//             comment.classList.add('d-none');
//         })
      }
    //   , { once: true }
      )
    
  })
