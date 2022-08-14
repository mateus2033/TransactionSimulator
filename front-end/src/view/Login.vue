<template>
    <div>

        <!-- Cabeçalho -->
        <div>
            <Header></Header>
        </div>

        <!-- Form login-->
        <div>
            <FormLogin></FormLogin>
        </div>

        <!--Footer-->

        <div class=" footer"> 
            <Footer></Footer>
        </div>

    </div>
</template>


<style>

.footer {

  bottom: 0;
  left: 0;
  position: fixed;
  width: 100%;
}

</style>



<script>

import Header from '../components/Header.vue'
import FormLogin from '../components/Forms/FormLogin.vue'
import Footer from '../components/Footer.vue';


export default {
    name: "Login",
    components:{Header,FormLogin, Footer}
}
</script>