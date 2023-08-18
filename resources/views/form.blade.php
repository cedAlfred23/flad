<!DOCTYPE html>
<html lang="en">

<head> 
  <title>FladConnect</title>
   @include('widgets/head')

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        @include('widgets/navbar')


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->


        <!-- Contact Start -->
        <style>
            form {
              max-width: 500px;
              margin: 0 auto;
            }
        
            label {
              display: block;
              margin-top: 10px;
              font-weight: bold;
            }
            input[type="text"],
            select,
            textarea {
              width: 100%;
              padding: 10px;
              border: 1px solid #ccc;
              border-radius: 4px;
              box-sizing: border-box;
              font-size: 16px;
            }
        
            textarea {
              height: 120px;
            }
        
            input[type="range"] {
              width: 50%;
            }
        
            output {
              display: inline-block;
              margin-top: 10px;
            }
        
            ul {
              list-style-type: none;
              padding: 0;
            }
        
            ul li {
              margin-bottom: 10px;
            }
        
            input[type="submit"] {
              background-color: #4CAF50;
              color: white;
              padding: 10px 20px;
              border: none;
              border-radius: 4px;
              cursor: pointer;
              font-size: 16px;
            }
        
            input[type="submit"]:hover {
              background-color: #45a049;
            }
          </style>
          </style>
        </head>
        <body>
          
          @if (session('ok'))
            <div class="p-3 bg-success">
              {{ session('ok')}}
            </div>
        @endif


          {{-- onsubmit="saveFormData(event)" --}}
          <form action="{{url('store/job')}}" method="POST" >
            @csrf

            <label for="jobTitle">Job Title:</label>
            <input type="text" id="jobTitle" name="jobTitle" required>
        
            <label for="jobLocation">Job Location:</label>
            <input type="text" id="jobLocation" name="jobLocation" required>
        
            <label for="jobType">Job Type:</label>
            <select id="jobType" name="jobType" required>
              <option value="fullTime">Full Time</option>
              <option value="partTime">Part Time</option>
            </select>
        
            <label for="salaryRange1">Salary Range1:</label>
            <input type="range" id="salaryRange1" name="salaryRange1" min="500" max="10000" step="10" required>
            <output for="salaryRange1" id="salaryValue1">ghc5000</output>

            <label for="salaryRange2">Salary Range2:</label>
            <input type="range" id="salaryRange2" name="salaryRange2" min="500" max="10000" step="10" required>
            <output for="salaryRange2" id="salaryValue2">ghc5000</output>
        
            <label for="jobDescription">Job Description:</label>
            <textarea id="jobDescription" name="jobDescription" required></textarea>
        
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" required>
        
            <label for="responsibilities">Responsibilities:</label>
            <ul id="responsibilitiesList" class="dynamic-list">
              <li>
                <input type="text" name="responsibilities[]" required>
                <button type="button" onclick="addResponsibility()">+</button>
              </li>
            </ul>
        
            <label for="qualifications">Qualifications:</label>
            <ul id="qualificationsList" class="dynamic-list">
              <li>
                <input type="text" name="qualifications[]" required>
                <button type="button" onclick="addQualification()">+</button>
              </li>
            </ul>
            <input type="submit" value="Post Job">
          </form>
          <script>
        
        const addResponsibility = () => {
              const list = document.getElementById('responsibilitiesList');
              const listItem = document.createElement('li');
              listItem.innerHTML = `
                <input type="text" name="responsibilities[]" required>
                <button type="button" onclick="addResponsibility(this)">+</button>
                <button type="button" onclick="removeListItem(this)">-</button>
              `;
              list.appendChild(listItem);
            };
        
            const addQualification = () => {
              const list = document.getElementById('qualificationsList');
              const listItem = document.createElement('li');
              listItem.innerHTML = `
                <input type="text" name="qualifications[]" required>
                <button type="button" onclick="addQualification(this)">+</button>
                <button type="button" onclick="removeListItem(this)">-</button>
              `;
              list.appendChild(listItem);
            };
        
            const removeListItem = (button) => {
              const listItem = button.parentNode;
              const list = listItem.parentNode;
              list.removeChild(listItem);
            };
        
            // Update the displayed salary value
            const salaryRange1 = document.getElementById('salaryRange1');
            const salaryValue1 = document.getElementById('salaryValue1');
        
            salaryRange1.addEventListener('input', () => {
              salaryValue1.textContent = 'ghc' + salaryRange1.value;
            });

            const salaryRange2 = document.getElementById('salaryRange2');
            const salaryValue2 = document.getElementById('salaryValue2');
        
            salaryRange2.addEventListener('input', () => {
              salaryValue2.textContent = 'ghc' + salaryRange2.value;
            });
        
          function saveFormData(event) {
            event.preventDefault(); // Prevent form submission
        
            // Get form values
            const jobTitle = document.getElementById('jobTitle').value;
            const jobLocation = document.getElementById('jobLocation').value;
            const jobType = document.getElementById('jobType').value;
            const salaryRange1 = document.getElementById('salaryRange1').value;
            const salaryRange2 = document.getElementById('salaryRange2').value;
            const jobDescription = document.getElementById('jobDescription').value;
            const deadline = document.getElementById('deadline').value;
            const responsibilities = Array.from(document.querySelectorAll('#responsibilitiesList input')).map(input => input.value);
            const qualifications = Array.from(document.querySelectorAll('#qualificationsList input')).map(input => input.value);
        
            // Create an object to hold the form data
            const formData = {
              jobTitle,
              jobLocation,
              jobType,
              salaryRange1,
              salaryRange2,
              jobDescription,
              deadline,
              responsibilities,
              qualifications
            };
        
            // Store the form data in local storage
            localStorage.setItem('jobFormData', JSON.stringify(formData));
        
            // Redirect to another page
            window.location.href = 'checkout.html';
          }
          </script>
        <!-- Contact End -->

@include('widgets/footer')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('widgets/js')
</body>

</html>