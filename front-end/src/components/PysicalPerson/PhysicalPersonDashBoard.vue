<template>
    <div>
        <!-- Cabeçalho do Dashboard -->
        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>

        <div>
            <PhysicalPersonContentVue></PhysicalPersonContentVue>
        </div>

 
    </div>
</template>

<script>

import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue';
import PhysicalPersonContentVue from './PhysicalPersonContent.vue';
import FooterDashBoard from '../Person/FooterDashBoard.vue';

export default {
    name: "PhysicalPersonDashBoard",
    components: { HeaderDashBoardPerson,PhysicalPersonContentVue, FooterDashBoard }
}

</script>