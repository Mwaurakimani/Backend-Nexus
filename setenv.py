import os

# Set the desired environment
desired_environment = "production"  # You can modify this based on your needs

# Set the environment variable for Laravel
os.environ['APP_ENV_ALIAS'] = desired_environment

# Load the content of the corresponding file
if desired_environment == "local":
    with open('.env.local', 'r') as file:
        content = file.read()
elif desired_environment == "production":
    with open('.env.prod', 'r') as file:
        content = file.read()
else:
    print("Invalid or undefined environment alias.")
    exit(1)

# Update the content of the .env file
with open('.env', 'w') as file:
    file.write(content)

print(f"Environment set to: {desired_environment}")
