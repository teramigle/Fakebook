class Filter{
    constructor(searchGroup, tagSpan) {
      this.input = searchGroup.querySelector('input');
      searchGroup.querySelector('button').addEventListener('click', this.add.bind(this));
      this.input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            searchGroup.querySelector('button').click();
        }
      });
      this.tagSpan = tagSpan;
      this.tags = [];
      this.contents = [];
      this.usernames = [];
    }
  
    add() {
      let keyword = this.input.value.toUpperCase();
      let tagText = this.input.value;
      console.log(keyword);
      if (keyword === '' || this.tags.includes(keyword)) {
        this.input.value = '';
        return;
      }
      let tag = document.createElement('span');
      tag.className = 'badge rounded-pill bg-white border border-secondary text-secondary fs-5 mx-1 mb-2';
      tag.innerText = tagText;
      let x = document.createElement('span');
      x.className = 'ms-2 pointer text-secondary';
      x.innerHTML = '&times';
      tag.appendChild(x);
      x.style.cursor = 'pointer';
      x.addEventListener("click", (event) => {
        event.target.parentNode.remove();
        let index = this.tags.indexOf(keyword);
        this.tags.splice(index, 1);
        filter.filter();
      });
      this.tagSpan.appendChild(tag);
      this.tags.push(keyword);
      console.log(this.tags);
      this.input.value = '';
      this.filter();
    }
  
    filter() {
      const content = [...document.querySelectorAll(".content")];
      const users = [...document.querySelectorAll(".username")];

      this.contents = content.map(
        (item) => item.innerText.toUpperCase()
      );
    
      this.usernames = users.map(
        (item) => item.innerText.toUpperCase()
      );
      
      const cards = [...document.querySelectorAll(".post-card")];
    //   console.log(cards);
      cards.forEach(card=>{
        card.parentElement.classList.remove("d-none");
      });


      this.tags.forEach((tag)=>this.contents.forEach((cont, index)=>
        {
            content[index].parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
            console.log(index);
            console.log(cont);
            
            if(cont.search(tag)==-1){
            console.log(tag);
            console.log('nerado content su tokiu tagu');
            this.tags.forEach((tag)=>
                {  
                console.log(this.usernames[index]);
                if(this.usernames[index].search(tag)==-1){
                    console.log(this.usernames[index]);
                    console.log(users[index]);
                    console.log('nerado username su tokiu tagu');
                    console.log(users[index].parentElement.parentElement.parentElement.parentElement);
                    users[index].parentElement.parentElement.parentElement.parentElement.classList.add("d-none");
                } else {
                    console.log('rado username su tokiu tagu');
                    users[index].parentElement.parentElement.parentElement.parentElement.classList.remove("d-none");
                }
                }
            );
            
            console.log('d-none added')
            console.log(content[index].parentElement.parentElement.parentElement.parentElement);
            index+=1;
            
        } else {
        
        console.log(content[index]);
        content[index].parentElement.parentElement.parentElement.parentElement.classList.remove("d-none");
        index+=1;
        console.log(index);
        }
        
      }
      ));
    };
    
  }
  
  let filter = new Filter(document.querySelector('#search'), document.querySelector('#tags-span'));