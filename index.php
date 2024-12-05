<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

.ubuntu-light {
  font-family: "Ubuntu", sans-serif;
  font-weight: 300;
  font-style: normal;
}

.ubuntu-regular {
  font-family: "Ubuntu", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.ubuntu-medium {
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  font-style: normal;
}

.ubuntu-bold {
  font-family: "Ubuntu", sans-serif;
  font-weight: 700;
  font-style: normal;
}

.ubuntu-light-italic {
  font-family: "Ubuntu", sans-serif;
  font-weight: 300;
  font-style: italic;
}

.ubuntu-regular-italic {
  font-family: "Ubuntu", sans-serif;
  font-weight: 400;
  font-style: italic;
}

.ubuntu-medium-italic {
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  font-style: italic;
}

.ubuntu-bold-italic {
  font-family: "Ubuntu", sans-serif;
  font-weight: 700;
  font-style: italic;
}

label{
  font-size: 15px;
}

button{
  font-size: 15px !important;
}

.wrap-list {
  max-width: 300px;  /* Set the desired width */
  word-wrap: break-word;  /* Allow words to break and wrap to the next line */
  padding: 0;  /* Optionally remove padding if needed */
}

td{
  font-family: verdana;
  font-size: 15px;
  font-weight: 400;
}

</style>
</head>
<body>
    <div class="container py-5 mt-3">
        <h1 class="text-center mb-4 ubuntu-bold">IP Tracker</h1>
        
                  <label class="ubuntu-regular">Leave blank to check your own IP</label>
        <div class="card mb-4">
            <div class="card-body">
                <form id="ipForm">
                    <div class="input-group">
                        <input type="text" id="ip" class="form-control" placeholder="Enter IP Address (leave blank for your IP)">
                        <button type="submit" class="btn btn-primary">Track</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="result" class="card d-none ubuntu-light">
            <div class="card-body">
                <h5 class="mb-3">Location Details</h5>
                <p><strong>IP Address:</strong> <span id="ipAddress"></span></p>
                <p><strong>Country:</strong> <span id="country"></span></p>
                <p><strong>Region:</strong> <span id="region"></span></p>
                <p><strong>City:</strong> <span id="city"></span></p>
                <p><strong>Latitude:</strong> <span id="latitude"></span></p>
                <p><strong>Longitude:</strong> <span id="longitude"></span></p>
                <p><strong>ISP:</strong> <span id="isp"></span></p>
                <p><strong>Time Zone:</strong> <span id="timezone"></span></p>
            </div>
        </div>
        
        <h5 class="mt-5 ubuntu-medium">History</h5>
       <div class="table-responsive">
        <table class="table table-striped" id="historyTable">
            <thead class="ubuntu-light">
                <tr>
                    <th>#</th>
                    <th>IP Address</th>
                    <th>Country</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>ISP</th>
                    <th>Time Zone</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
       </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch history
            fetchHistory();

            // Handle form submission
            $('#ipForm').on('submit', function (e) {
                e.preventDefault();
                let ip = $('#ip').val();
                $.post('track_ip.php', { ip: ip }, function (data) {
                    const result = JSON.parse(data);
                    if (result.error) {
                        alert(result.error);
                    } else {
                        $('#ipAddress').text(result.query);
                        $('#country').text(result.country);
                        $('#region').text(result.regionName);
                        $('#city').text(result.city);
                        $('#latitude').text(result.lat);
                        $('#longitude').text(result.lon);
                        $('#isp').text(result.isp);
                        $('#timezone').text(result.timezone);
                        $('#result').removeClass('d-none');
                        fetchHistory();
                    }
                });
            });
        });

        function fetchHistory() {
            $.get('fetch_history.php', function (data) {
                const history = JSON.parse(data);
                let rows = '';
                history.forEach((item, index) => {
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.ip_address}</td>
                            <td>${item.country}</td>
                            <td>${item.region}</td>
                            <td>${item.city}</td>
                            <td>${item.latitude}</td>
                            <td>${item.longitude}</td>
                            <td>${item.isp}</td>
                            <td>${item.timezone}</td>
                            <td>${item.created_at}</td>
                        </tr>`;
                });
                $('#historyTable tbody').html(rows);
            });
        }
    </script>
</body>
</html>
