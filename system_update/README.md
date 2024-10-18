# GitHub Website Updater

GitHub Website Updater is a web-based tool that allows you to automatically update your website content from a GitHub repository. It provides a simple interface to configure your GitHub repository details, initiate updates, and track the progress of the update process.

## Features

- Update website content from a specified GitHub repository
- Real-time progress tracking with a progress bar
- Configuration management for GitHub repository details
- Secure storage of GitHub access token in a local file (ignored by git)
- Responsive design using Bootstrap

## Prerequisites

Before you begin, ensure you have met the following requirements:

- Web server with PHP 7.4+ support
- GitHub account and personal access token with appropriate permissions

## Installation

1. Clone this repository to your web server:

   ```
   git clone https://github.com/yourusername/github-website-updater.git
   ```

2. Create a `config.json` file in the project root with the following structure:

   ```json
   {
     "repo_owner": "",
     "repo_name": "",
     "file_path": "",
     "access_token": ""
   }
   ```

3. Ensure that the web server has write permissions for the directory where the project is located, especially for the `config.json` file.

4. Add `config.json` to your `.gitignore` file to prevent accidentally committing sensitive information:

   ```
   echo "config.json" >> .gitignore
   ```

## Usage

1. Access the main page (`index.html`) through your web browser.

2. Click on the "Configuration" button to set up your GitHub repository details:
   - Repository Owner
   - Repository Name
   - File Path (path to the file you want to update)
   - GitHub Access Token

3. Save the configuration.

4. Return to the main page and click the "Update Website" button to initiate the update process.

5. The progress bar will show the status of the update. Once complete, you'll see a success message.

6. The updated content will be displayed on the main page.

## File Structure

- `index.html`: Main page with update button and progress bar
- `config.html`: Configuration page for GitHub repository details
- `update.php`: Handles the update process
- `progress.php`: Tracks and returns the update progress
- `config.php`: Manages the configuration (load/save)
- `config_functions.php`: Functions for reading and writing configuration
- `config.json`: Stores the configuration data (ignored by git)

## Security Considerations

- The `config.json` file is ignored by git to prevent accidentally committing sensitive information. Make sure to keep this file secure and not expose it publicly.
- Ensure that your `config.json` file is not accessible from the web. You can do this by placing it outside the web root or by configuring your web server to deny access to .json files.
- Use HTTPS to encrypt data transmission, especially for the configuration page where the GitHub access token is submitted.
- Regularly update your GitHub access token and avoid sharing it publicly.

## Contributing

Contributions to the GitHub Website Updater project are welcome. Please feel free to submit a Pull Request. When contributing, please remember:

1. Do not commit the `config.json` file or any sensitive information.
2. Test your changes thoroughly before submitting a pull request.
3. Follow the existing code style and conventions.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

If you encounter any problems or have any questions, please open an issue in the GitHub repository.

## Troubleshooting

- If you're having issues with permissions, make sure your web server has write access to the project directory, especially the `config.json` file.
- If the update process fails, check your GitHub access token permissions and ensure it has the necessary scope to read the specified repository and file.
- For any other issues, check the PHP error logs and browser console for more detailed error messages.

Remember to always keep your `config.json` file secure and never commit it to version control or share it publicly.