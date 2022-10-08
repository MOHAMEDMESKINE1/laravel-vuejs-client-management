<template>

  
    <div v-if="show_alert" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">Client est bien modifié !</span> 
    </div>
  
     <form class="space-y-6" @submit.prevent="updateClient">
          <div class="space-y-4 rounded-md shadow-sm">
              <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                  <div class="mt-1">
                      <input required type="text" name="name" id="name"
                              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="customer.name">
                  </div>
              </div>
  
              <div>
                  <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                  <div class="mt-1">
                      <input required type="text" name="tel" id="tel"
                              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="customer.tel">
  
                  </div>
              </div>
  
             
  
              <div>
                  <label for="is_favourite" class="block text-sm font-medium text-gray-700">Favourite ?</label>
                  <div class="mt-1">
                      <input  type="checkbox" name="is_favourite" id="is_favourite"
                              class="block p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="customer.is_favourite">
                  </div>
              </div>
          </div>
  
          <button type="submit"
                  class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-800 border border-transparent rounded-md ring-green-300 hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring disabled:opacity-25">
                Modifier
          </button>
      </form>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  
  import useCustomers from '../services/customer_services';
  export default {
    // get the id from Customerindex.vue using props 
    props : {
        id: {
            required:true,
            type:String
        }
    },
     setup (props){

        
            // call use useCustomers from cutomers_services.js  file 
            const {updateCustomer,getCustomer} = useCustomers();
           
          
            // onMounted
            onMounted(()=> getCustomer(props.id))
  
            // update Client
            const updateClient =async  () =>
              {
                    
                try {
                    
                    show_alert.value = true;

                    updateCustomer(props.id);

                    //  hide alert after 1.5 second
                    setTimeout(() => {
                        show_alert.value = false;

                    }, 1500);
                    
                
                } catch (error) {

                    console.log(error.message);
                }
                  
                
            }
              
  
              return {
                show_alert,
                getCustomer,
                props,
                 updateClient,
               
            }
    }
}
  </script>
  
  <style>
  
  </style>