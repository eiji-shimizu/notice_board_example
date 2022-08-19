
import axios from 'axios';

const PROTOCOL = 'http';
const HOST = 'localhost';
const PORT = '8000';
const APP_NAME = 'noticeboard';

function createUrl(url: string): string {
    return PROTOCOL + '://' + HOST + ':' + PORT + '/' + 'api' + '/' + APP_NAME + '/' + url;
}

async function get(url: string): Promise<JSON> {
    let response = await axios.get(createUrl(url));
    return (response.data as JSON);
}


export { get };