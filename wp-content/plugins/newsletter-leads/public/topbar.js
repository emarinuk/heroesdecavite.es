function tnp_leads_topbar_close() {
    window.localStorage.setItem('tnp-leads-topbar', '' + (new Date().getTime()));
    document.getElementById('tnp-leads-topbar').className = '';
}

function tnp_leads_topbar_run() {
    console.log('Topbar: run');
    let test = newsletter_leads_topbar_data.test == '1';
    let time = window.localStorage.getItem('tnp-leads-topbar');
    if (!test && time !== null && (new Date().getTime()) < parseInt(time) + parseInt(newsletter_leads_topbar_data.restart)) {
        console.log('Topbar: blocked');
        document.getElementById('tnp-leads-topbar').style.display = 'none';
    } else {
        console.log('Topbar: show');
        document.getElementById('tnp-leads-topbar').className = 'tnp-leads-topbar-show';
    }
}

if (document.readyState !== 'loading') {
    tnp_leads_topbar_run();
} else {
    document.addEventListener("DOMContentLoaded", function () {
        tnp_leads_topbar_run();
    });
}

