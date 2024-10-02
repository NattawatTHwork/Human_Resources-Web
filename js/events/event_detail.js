document.addEventListener("DOMContentLoaded", async () => {
    try {
        const sessionToken = await getSessionToken();
        showData(await fetchData(sessionToken.token));
    } catch (error) {
        handleError(error);
    }
});

async function fetchData(token) {
    const event_id = getQueryParam('event_id');
    const personal_id = getQueryParam('personal_id');

    const response = await fetch(`${apiUrl}events/get_event_activity.php?event_id=${event_id}&personal_id=${personal_id}`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });
    return response.json();
}

function showData(datas) {
    document.getElementById('event_name').innerText = datas.data[0].event_name;
    document.getElementById('event_detail').innerText = datas.data[0].event_detail;
    document.getElementById('event_date').innerText = new Date(datas.data[0].event_date).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('event_date_to').innerText = new Date(datas.data[0].event_date_to).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' });

    let cardContainer = document.getElementById('cardContainer');
    cardContainer.innerHTML = '';

    datas.data.forEach(data => {

        const dateMonthFormatter = new Intl.DateTimeFormat('th-TH', { day: 'numeric', month: 'long' });
        const formattedDateMonth = dateMonthFormatter.format(new Date(data.create_at));

        const YearFormatter = new Intl.DateTimeFormat('th-TH', { year: 'numeric' });
        const formattedYear = YearFormatter.format(new Date(data.create_at));

        const TimeFormatter = new Intl.DateTimeFormat('th-TH', { hour: 'numeric', minute: 'numeric' });
        const formattedTime = TimeFormatter.format(new Date(data.create_at));

        let cardHtml = `
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${data.title}</h5>
                        <p class="card-text"><strong>รายละเอียด:</strong> ${data.detail}</p>
                        <p class="card-text"><strong>วันที่บันทึก:</strong> ${formattedDateMonth + ' ' + formattedYear + ' เวลา ' + formattedTime + 'น.'}</p>
                        <p class="card-text"><strong>ความคืบหน้า:</strong> ${data.percent} %</p>
                    </div>
                </div>
            </div>`;

        cardContainer.innerHTML += cardHtml;
    });
}

function toggleAdditionalInfo(elementId, button) {
    let additionalInfo = document.getElementById(elementId);
    let arrow = button.querySelector('.arrow');
    if (additionalInfo.style.display === "none") {
        additionalInfo.style.display = "block";
        arrow.innerHTML = texts.hide;
        arrow.style.transform = "rotate(180deg)";
    } else {
        additionalInfo.style.display = "none";
        arrow.innerHTML = texts.view;
        arrow.style.transform = "rotate(0deg)";
    }
}