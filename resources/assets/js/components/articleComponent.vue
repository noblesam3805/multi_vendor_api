<template>
 <center>   <div>

   <h1>article</h1>
<form class="mb-2" @submit.prevent="addArticle">

<div class="form-group">
<input type="text" class="form-control" v-model="article.title" placeholder="title">
</div>

<div class="form-group">
<textarea class="form-control" v-model="article.body" placeholder="body"></textarea>
</div>
<button type="submit" class="btn btn-success">save</button>
</form>
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" v-bind:class="[{disabled: !pagination.prev}]"><a class="page-link" href="#" @click="fetchArticles(pagination.prev)">Previous</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">{{pagination.current_page}}/{{pagination.last_page}}</a></li>
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"><a class="page-link" @click="fetchArticles(pagination.next)" href="#">Next</a></li>
  </ul>
</nav>

   <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
   <h3> {{article.title}}</h3>
   <p> {{article.body}}</p>
   <button @click="editArticle(article)" type="submit" class="btn btn-warning" >Edit</button><br><br>
   <button @click="deleteArticle(article.id)" type="submit" class="btn btn-danger" >Delete</button>
   </div>

   </div></center>

</template>

<script>

export default {

data(){
    return {
    articles: [],
    article: {
    id:'',
    title:'',
    body:''
},
article_id : '',
pagination:{},
edit:false
};
},

created() {
    this.fetchArticles();
},

methods: {
    fetchArticles(page_url){
        page_url=page_url || 'api/article';
        let vm = this;
        fetch(page_url)
        .then(res => res.json())
        .then(res => {
            this.articles = res.data;
            vm.makepagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
        },
        makepagination(meta,links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next: links.next,
                prev: links.prev
            };
            this.pagination=pagination;
        },
        deleteArticle(id){
            if(confirm('Are you sure')){
            fetch(`api/articles/${id}`, {method: 'delete'})
            .then(res => res.json())
            .then(data=>{alert('article removed');
            this.fetchArticles()})
            .catch(err => console.log(err));
            }
        },

        addArticle(){
            if(this.edit === false){
                fetch('api/article', {
                method:'post',
                body:JSON.stringify(this.article),
                headers:{
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                this.article.title='';
                this.article.body='';
                alert('Article added');
                this.fetchArticles;
            }).catch(err => console.log(err));
            }
            else{

                fetch('api/article', {
                method:'put',
                body:JSON.stringify(this.article),
                headers:{
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                this.article.title='';
                this.article.body='';
                alert('Article updated');
                this.fetchArticles;
            }).catch(err => console.log(err));

            }
        },

        editArticle(article){
            this.edit=true;
            this.article.id=article.id;
           
            this.article.title=article.title;
            this.article.body=article.body;
        }
    }
};

</script>