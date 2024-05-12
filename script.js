// Fetch data from JSON file
fetch('loclist.json')
  .then(response => response.json())
  .then(data => {
    const regionSelect = document.getElementById("region");
    // Populate region select options
    Object.keys(data).forEach(regionCode => {
      const region = data[regionCode];
      const option = document.createElement("option");
      option.value = regionCode;
      option.textContent = region.region_name;
      regionSelect.appendChild(option);
    });

    // Event listener for region select
    regionSelect.addEventListener("change", function() {
      const selectedRegionCode = this.value;
      const provinceSelect = document.getElementById("province");
      // Clear province select options
      provinceSelect.innerHTML = '<option value="">Select Province</option>';
      // Populate province select options based on selected region
      const provinceList = data[selectedRegionCode].province_list;
      Object.keys(provinceList).forEach(province => {
        const option = document.createElement("option");
        option.value = province;
        option.textContent = province;
        provinceSelect.appendChild(option);
      });
    });

    // Event listener for province select
    const provinceSelect = document.getElementById("province");
    provinceSelect.addEventListener("change", function() {
      const selectedRegionCode = regionSelect.value;
      const selectedProvince = this.value;
      const municipalitySelect = document.getElementById("city");
      // Clear municipality select options
      municipalitySelect.innerHTML = '<option value="">Select City/Municipality</option>';
      // Populate municipality select options based on selected province
      const municipalityList = data[selectedRegionCode].province_list[selectedProvince].municipality_list;
      Object.keys(municipalityList).forEach(municipality => {
        const option = document.createElement("option");
        option.value = municipality;
        option.textContent = municipality;
        municipalitySelect.appendChild(option);
      });
    });

    // Event listener for municipality select
    const municipalitySelect = document.getElementById("city");
    municipalitySelect.addEventListener("change", function() {
      const selectedRegionCode = regionSelect.value;
      const selectedProvince = provinceSelect.value;
      const selectedMunicipality = this.value;
      const barangaySelect = document.getElementById("barangay");
      // Clear barangay select options
      barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
     
      // Populate barangay select options based on selected municipality
      const barangayList = data[selectedRegionCode].province_list[selectedProvince].municipality_list[selectedMunicipality].barangay_list;
      barangayList.forEach(barangay => {
        const option = document.createElement("option");
        option.value = barangay;
        option.textContent = barangay;
        barangaySelect.appendChild(option);
      });
    });
  })
  .catch(error => console.error('Error fetching data:', error));


  // to display file name of pdf
function displayFileName(input) {
    var file = input.files[0];
    var fileNameDisplay = document.getElementById("file-name");

    if (file) {
        fileNameDisplay.textContent = "File Name: " + file.name;
        fileNameDisplay.style.display = "block";
        document.getElementById("upload-text").style.display = "none";
    } else {
        fileNameDisplay.textContent = "";
        fileNameDisplay.style.display = "none";
        document.getElementById("upload-text").style.display = "block";
    }
}





  