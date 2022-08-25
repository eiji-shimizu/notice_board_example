
import axios from 'axios';

const PROTOCOL = 'http';
const HOST = 'localhost';
const PORT = '8000';
const APP_NAME = 'noticeboard';

function createUrl(url: string): string {
    return PROTOCOL + '://' + HOST + ':' + PORT + '/' + APP_NAME + '/' + url;
}

async function get(url: string): Promise<JSON> {
    let response = await axios.get(createUrl(url));
    return (response.data as JSON);
}

async function post(url: string, data: FormData): Promise<JSON> {
    let response = await axios.post(createUrl(url), data);
    return (response.data as JSON);
}

export { get, post, createUrl };