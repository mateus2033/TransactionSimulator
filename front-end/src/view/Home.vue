<template>
    <div>

        <div>
            <Header></Header>
        </div>

        <div>
            <Content></Content>
        </div>

        <div>
            <Footer></Footer>
        </div>

    </div>
</template>

<script>


import Header from '../components/Header.vue';
import Content from '../components/Content.vue';
import Footer from '../components/Footer.vue';


export default {
    name: "Home",
    components: { Header, Content, Footer }
}

</script>