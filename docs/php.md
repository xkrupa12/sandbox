### Continuous Integration
To set up CI for project, it's possible to use Travis CI (free for OSS)

Signing up:
1. Go to [travis-ci.org](https://travis-ci.org)
2. Sign up via GH account
3. Enable CI for a repository

Configuration:
CI configuration is stored in `.travis.yml` file, that contains language settings as well as commands that needs to be run when changes are pushed to repository
For CI there is also .env.travis containing special ENV settings for CI build

#### [back](./../readme.md)