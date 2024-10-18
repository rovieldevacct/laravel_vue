<template>

<div class="card">
    <div class="card-header">
        <h4>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/>
            </svg>
            Edit Product
            <router-link to="/products" class="btn btn-primary float-end">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1em">
                    <path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z"/>
                </svg>                
                Product
            </router-link>
        </h4>
        
    </div>
    <div class="card-body">
        <ul v-if="this.errorList" class="alert alert-warning" >
            <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" >
                {{ error[0] }}
            </li>
        </ul>
        <ul v-if="this.successMsg" class="alert alert-success" >
            <li class="mb-0 ms-3" >
                {{ this.successMsg }}
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
        </div>                        
        <div class="mb-3">
            <button class="btn btn-primary" @click="updateProduct">
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
                successMsg: null,
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
            this.getProductData(this.$route.params.id);
            
            
        },
        methods: {
            hide_alert: function(event){
                window.setInterval(()=>{
                    this.alert = false;
                },3000)

            },
            getProductData(productId){
                axios.get(`/api/products/${productId}/edit_api`)
                .then(response => { 
                    this.model.product = {
                        name: response.data.name,
                        category_id: response.data.category_id,
                        description: response.data.name,
                    }
                 })
                 .catch(function(error){
                        
                        if(error.response){
                            if(error.response.status === 404){
                                mrErr.errorList = error.response.data.errors;                                
                            }                            
                        }
                    });



            },
            loadProduct(){
                axios.get('/api/products/create_api')
                .then(response => { this.category = response.data });
                
            },            
            updateProduct(){
                var mrErr = this;
                
                axios.put(`/products/${this.$route.params.id}`, this.model.product)
                    .then(res=>{
                        
                       
                        this.errorList= null;
                        if(res.status == 200){
                            mrErr.successMsg = res.data.message;
                            
                        }
                        
                        
                        // this.$router.push('/products')
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