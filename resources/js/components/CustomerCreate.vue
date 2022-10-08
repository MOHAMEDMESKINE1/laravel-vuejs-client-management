<template>

  <div class="mb4">
       <!-- <ul v-if="errors !== '' ">
            <li> {{errors}}</li>
       </ul> -->
       <div v-if="erreurs" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
          <span class="font-medium">{{erreurs}}</span> 
      </div>
  </div>
  <div v-if="show_alert" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
      <span class="font-medium">Client est bien ajouté !</span> 
  </div>

   <form class="space-y-6" @submit.prevent="addClient">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input  type="text" name="name" id="name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.name">
                </div>
            </div>

            <div>
                <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <div class="mt-1">
                    <input type="text" name="tel" id="tel"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.tel">

                </div>
            </div>

           

            <div>
                <label for="is_favourite" class="block text-sm font-medium text-gray-700">Favourite ?</label>
                <div class="mt-1">
                    <input type="checkbox" name="is_favourite" id="is_favourite"
                            class="block p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.is_favourite">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
              Enregistrer
        </button>
    </form>
</template>

<script>
import { ref,reactive, computed } from 'vue';

import useCustomers from '../services/customer_services';
export default {
   setup (){
       
            const show_alert = ref(false)
            
            // const input=ref('')

            // const erreurs = computed(()=>{

            //     return input.value ===""  ? "champ obligatoire" : ""
            // });

            const  form =reactive({
                name:"",
                tel:"",
                is_favourite:false,
            });
           
            // afficher les  erreurs methode 1
              const erreurs = computed(()=>{

                return form.name ==="" ||  form.tel ==="" || form.is_favourite ===""   ? "champs obligatoire" : "";

              });

            // call use useCustomers from cutomers_services.js 
            const {createCustomers,errors} = useCustomers();

            // add Client
            const addClient =async ()=>{
                  
                try {

                  if(form.name !=="" && form.tel !=="" && form.is_favourite !==""){
                    
                    show_alert.value = true;

                    await createCustomers({...form})

                    //  hide alert after 1 second
                    setTimeout(() => {
                        show_alert.value = false;

                    }, 1500);
                  }
                  
                } catch (error) {

                    console.log(error.message);
                }
                
              
            }
            

            return {show_alert,form,errors,addClient,erreurs}
    }
}
</script>

<style>

</style>