import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

export default function useCustomers(){
    
    const errors = ref('') ;

    const customer = ref('');
    
    const customers = ref([]);
    
    const router = useRouter();

    // get Customerss
    const getCustomers = async () =>{

        let response = await axios.get("/api/customers");

        customers.value  = response.data.data ;

    }
    // create a customer
    const createCustomers = async (data) =>{

        try {
            // clear errors
            errors.value = '' ;
            await axios.post("/api/customers",data);

            setTimeout(() => {
                // redirection vers index 
                router.push({name:'customers.index'})

              }, 1500);

        } catch (error) {

            const createcustomersErrors = error.response.data.errors;

            for(const key in createcustomersErrors)
            {
                errors.value+=createcustomersErrors[key][0] +''
            }
           
        }

    }

    // get customer
     const getCustomer = async (id) =>{

        let response = await axios.get(`/api/customers/${id}`);

        customer.value  = response.data.data ;

    }
    // update customer
     const updateCustomer = async (id) =>{
        // clear errors
        errors.value = '' ;

        await axios.patch(`/api/customers/${id}`,customer);

        await router.push({name:'customers.index'});

    }
    // delete a customer
    const deleteCustomers = async (id) =>{

        await axios.delete(`/api/customers/${id}`);

        router.push({name:'customers.index'})


     
    }

    return {
        customer,
        getCustomer,
        getCustomers,
        createCustomers,
        updateCustomer,
        deleteCustomers,
        customers,
        customer,
        errors,

    }
}