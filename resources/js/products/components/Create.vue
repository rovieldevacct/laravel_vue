<template>

<div class="card">
    <div class="card-header">
        <h4>
            Create Product
            <router-link to="/products" class="btn btn-primary float-end">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1em">
                    <path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z"/>
                </svg>
                Product
            </router-link>
        </h4>
    </div>
    <div class="card-body">
        <ul v-if="this.errorList" class="alert alert-warning">
            <li class="mb-0 ms-3" v-for="(error, index) in this.errorList">
                {{ error[0] }}
            </li>
        </ul>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" v-model="model.product.name">
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select class="form-control" v-model="model.product.category_id">
                <option :value="categ.id" v-for="categ in category">{{ categ.name }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" v-model="model.product.description"></textarea>
            <!-- <input type="text" class="form-control" v-model="model.product.description"> -->
        </div>                        
        <div class="mb-3">
            <button class="btn btn-primary" @click="saveProduct">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" >
                    <path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-242.7c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32L64 32zm0 96c0-17.7 14.3-32 32-32l192 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32L96 224c-17.7 0-32-14.3-32-32l0-64zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                </svg>                
                Save
            </button>
        </div>
    </div>
    
</div>

    
</template>

<script>
    export default {        
        data(){
            return {
                errorList: null,
                model: {
                    product: {
                        name: '',
                        category_id: '',
                        description: '',
                    },
                    
                },
                category: []
            }
        },
        mounted () {
            this.loadProduct();            
        },
        methods: {
            loadProduct(){
                axios.get('/api/products/create_api')
                .then(response => { this.category = response.data });
                
            },            
            saveProduct(){
                var mrErr = this;
                axios.post('../products', this.model.product)
                    .then(res=>{
                        
                        this.model.product = {
                            name: '',
                            category_id: '',
                            description: '',
                        };
                        this.errorList= null;
                        
                        this.$router.push('/products')
                    })
                    .catch(function(error){
                        console.log(error.response.data)
                        if(error.response){
                            if(error.response.status === 422){
                                mrErr.errorList = error.response.data.errors;                                
                            }
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.header);
                        }else if(error.request){
                            console.log(error.request)
                        }else{
                            console.log('Error',error.message)
                        }
                    });
            }
        },
    }
  
</script>