<template>
   
        

<div v-if="show_alert" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <span class="font-medium">Client est bien supprimé !</span> 
</div>
<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <div class="flex">
        <router-link 
        class="bg-blue-500 mb-3 px-2 py-2  text-white rounded-sm shadow-md" 
        :to="{name:'customers.create'}" >

            Create a Customer
        </router-link>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                   Nom
                </th>                
                <th scope="col" class="py-3 px-6">
                   Téléphone 
                </th>
                <th scope="col" class="py-3 px-6">
                   Is Favourite 
                </th>
                <th scope="col" class="py-3 px-6">
                   Action 
                </th>
            </tr>
        </thead>
        <tbody>
           <template v-for="customer in customers" :key="customer.id">
                <tr class="bg-gray-400 border-b text-center  dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                        {{customer.name}}
                    </td>
                    <td class="py-4 px-6">
                        {{customer.tel}}
                    </td>
                    <td  >
                      <span
                        :class='{"text-white p-1 bg-green-400  mx-2 rounded-xl hover:bg-green-500 ": customer.is_favourite }'
                        v-text="customer.is_favourite">

                      </span>
                    </td>
            
                    <td class="py-4 px-4 text-center">
                        <!-- delete -->
                        <button @click="deleteCustomer(customer.id)"  class="font-medium px-2 py-2 rounded-md text-white bg-red-700 mx-2 hover:underline">Delete</button>
                       
                        <!-- edit -->
                        <router-link :to="{name:'customers.edit',params:{id:customer.id}}" class="font-medium px-2 py-2 rounded-md text-white bg-blue-700 hover:underline">Edit</router-link>
                       
                    </td>
                </tr>

           </template>
           
        </tbody>
    </table>
</div>




</template>

<script>
import { onMounted, ref } from 'vue';
import useCustomers from '../services/customer_services';
export default {
 
    setup(){
        // declarations
        const show_alert = ref(false)
        const {customers,getCustomers,deleteCustomers} = useCustomers()

        // get customers
       onMounted(getCustomers())
       
       // delete customer
       const deleteCustomer =async (id)=>{

         if(window.confirm('Are You Sure !')){
            
            // show alert
            show_alert.value = true;
           
            //  hide alert after 1.5 second
            setTimeout(() => {
                 show_alert.value = false;

            }, 1500);

            await deleteCustomers(id)
           
            getCustomers();
         }
            

       }
       return {
        show_alert,
        customers,
        getCustomers,
        deleteCustomer
       }
       
    } 
}
</script>

<style>

</style>