
const client  =  (resource: string): string =>  {
    return `http://127.0.0.1:8085/api/${resource}`;
}


 export default client;