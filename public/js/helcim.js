const TOKEN_LENGTH = 22;

function removeHelcimPayIframe () {
    const frame = document.getElementById('helcimPayIframe');
    if(frame instanceof HTMLIFrameElement) {
        frame.remove();
        window.removeEventListener('message', watchForExit, false);
    }
}

function watchForExit (event) {
    if (!event?.data?.eventName.includes('helcim-pay-js')) {
        return;
    }
    if (event?.data?.eventStatus === 'HIDE') {
        removeHelcimPayIframe();
    }
}

// eslint-disable-next-line @typescript-eslint/no-unused-vars
function appendHelcimPayIframe (token, showExitButton=true, phone='', email='', csrf='') {
    if(token === null || token === 'undefined' || token.length !== TOKEN_LENGTH) {
        console.error('Invalid checkout token.');
        return;
    }
    const isProduction = window.location.protocol === 'https:';

    const thirdPartyDevelopment = window.location.hostname === 'localhost';

    const domain = isProduction || thirdPartyDevelopment ? 'secure.helcim.app' : 'secure.helcim.app';
    const hasExitButtonQuery = showExitButton ? '?allowExit' : '';
    const phoneQuery = phone ? `&phone=${phone}` : '';
    const emailQuery = email ? `&email=${email}` : '';
    const url = `${window.location.protocol}//${domain}/helcim-pay/${token}${hasExitButtonQuery}${phoneQuery}${emailQuery}`;

    const iframeElem = document.createElement('iframe');
    iframeElem.name = csrf;
    iframeElem.id = 'helcimPayIframe';
    iframeElem.src = url;
    iframeElem.width = '100%';
    iframeElem.height = '100%';
    iframeElem.frameBorder = '0';
    iframeElem.style = 'position: fixed; top: 0; left: 0; border: none; z-index: 998;';

    if(showExitButton) {
        window.addEventListener('message', watchForExit, false);
    }

    return document.body.appendChild(iframeElem);
}