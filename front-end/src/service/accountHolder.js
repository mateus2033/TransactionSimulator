import { http } from "./config";

export default {

    login: (data) => {
        return http.post('/login', data)
    },

    createPhysicalPerson: (data) => {
        return http.post('/physicalPerson', data)
    },

    createLegalPerson: (data) => {
        return http.post('/legalPerson', data)
    },

    deposit: (data) => {
        return http.post('/accountholder/deposit', data, { headers: { Authorization: localStorage.getItem('token') } })
    },

    withdraw: (data) => {
        return http.post('accountholder/withdraw', data, { headers: { Authorization: localStorage.getItem('token') } })
    },

    transfer: (data) => {
        return http.post('accountholder/transfer', data, { headers: { Authorization: localStorage.getItem('token') } })
    },

    list: (data) => {
        return http.post('accountholder/list', data, { headers: { Authorization: localStorage.getItem('token') } })
    },

    listHistoric: (data) => {
        return http.post('accountholder/historicList', data, { headers: { Authorization: localStorage.getItem('token') } })
    }

}