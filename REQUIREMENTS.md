### Objective:
Evaluate proficiency in PHP Symfony development, Docker, and static code analysis.
### Duration:
- **Time Allotted**: 4 hours
### Submission Format:
- **Code Repository**: Submit a GitHub repository with all code and documentation.
- **Documentation**: Provide a [README.md](http://README.md) file with setup instructions, a brief description of the solution, and any assumptions made.
## Assessment Tasks

### 1. Symfony Project Development

### Task: Build a RESTful API using Symfony

- **Requirements**:
    - **Symfony Framework**: Use Symfony 5.4 or later.
    - **Doctrine ORM**: Implement database interactions with Doctrine ORM.
    - **JWT Authentication**: Secure endpoints using JWT authentication.
    - **API Endpoints**:
        - `GET /api/products` - List all products.
        - `POST /api/products` - Create a new product.
        - `GET /api/products/{id}` - Get details of a single product.
        - `PUT /api/products/{id}` - Update an existing product.
        - `DELETE /api/products/{id}` - Delete a product.
    - **Validation**: Use Symfony Validator component for request validation.
    - **Exception Handling**: Implement custom exception handling and error responses.
### Deliverables:

- **Code**: Implement the API endpoints with appropriate controllers, services, and repository classes.
- **Testing**: Write PHPUnit tests for the API endpoints.
### 2. Docker Configuration

### Task: Dockerize the Symfony Application

- **Requirements**:
    - **Dockerfile**: Create a Dockerfile for the Symfony application.
    - **docker-compose.yml**: Set up a Docker Compose file to manage the application and its dependencies (e.g., MySQL database).
    - **Environment Variables**: Use environment variables for configuration (e.g., database connection details).

### Deliverables:

- **Docker Configuration**: Provide the Dockerfile and docker-compose.yml files.
- **Documentation**: Include instructions on how to build and run the Docker containers.
### 3. Static Code Analysis

### Task: Integrate Static Code Analysis

- **Requirements**:
    - **Tools**: Use PHPStan and PHP_CodeSniffer.
    - **Configuration**: Configure PHPStan with appropriate levels and rules. Set up PHP_CodeSniffer with a PSR-12 standard.
    - **Code Quality**: Ensure the code follows best practices and passes the static analysis checks.

### Deliverables:

- **Configuration Files**: Provide `phpstan.neon`, `phpcs.xml`, and any other relevant configuration files.
- **Analysis Results**: Include the output of the static analysis and any fixes made to the codebase.
### 4. Documentation

### Task: Document

- **Requirements**:
    - **[README.md](http://README.md)**: Document the setup process, architecture overview, and any assumptions made during development.

### Deliverables:

- **[README.md](http://README.md)**: Include setup instructions, API documentation, and any additional notes.

---

## Additional Instructions:

- **Use Git**: Commit your changes regularly and push to a GitHub repository.
- **Testing**: Write tests for the API endpoints and ensure they are passing.
- **Documentation**: Make sure your [README.md](http://README.md) is comprehensive and includes all necessary information.
## Evaluation Criteria:

- **Code Quality**: Clean, readable, and well-structured code.
- **Architecture**: Logical and scalable application design.
- **Testing**: Coverage and quality of tests.
- **Documentation**: Clarity and completeness of documentation.
- **Technical Knowledge**: Proficiency in Symfony, Docker, and static code analysis tools.