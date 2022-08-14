<template>
    <div>
        
        <!-- Cabeçalho do Dashboard -->
        <div>
            <HeaderDashBoardPerson></HeaderDashBoardPerson>
        </div>
        
        <div>
            <LegalPersonContent></LegalPersonContent>
        </div>

    </div>
</template>

<script>

import HeaderDashBoardPerson from '../Person/HeaderDashBoardPerson.vue';
import LegalPersonContent    from './LegalPersonContent.vue';

export default {
    name: "LegalPersonDashboard",
    components: { HeaderDashBoardPerson, LegalPersonContent }

}
</script>