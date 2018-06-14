### Basics
- Git makes snapshots of every file for every commit. If file is not changed, stored is only link to the latest snapshot of file
- all commits are checksum-ed and referred via it's SHA-1 hash - this prevents from any unnoticed change or undetected file corruption
- every file is in one of 3 states:
    - committed - file is stored properly
    - modified - file is changed, but changes are not stored yet (not committed)
    - staged - file is modified and marked to be stored in new commit
- main sections of git project
    - git directory - contains git metadata and object database
    - working directory - single checkout of one version of project -> these are pulled out from compressed db of git directory and placed on disk to be modified
    - staging area - single file in git directory containing info of what files will go into next commit
- file statuses:
    - tracked - unmodified, modified or staged
    - untracked - git doesn't care about that file 
- basic workflow: changing files in working directory -> staging files and adding their snapshots into staging area -> committing changes - snapshots are permanently stored in git directory 

### Configuration
- stored globally in `~/.gitconfig` or for given repository in `.git/config`
- after installation, identity of user should be set up
    - `git config --global user.name "john doe"` - `--global` to store information globally (not for current project)
    - `git config --global user.email john@doe.com`
- editor preferences: 
    - `git config --global core.editor vim` - set up editor for dealing with commits & stuff
- list of current settings - `git config --list`

### Getting started
- there are 2 ways of how to start using git
    - to track brand new project, use `git init` in it's root directory
        - this prepares `.git` directory containing git skeleton
        - at this point, files are not tracked yet
    - to clone already existing project, use `git clone << repository url>>` 
        - this command creates folder named by the repository, creates `.git` directory within it & prepares all the files for modification
        - this command takes one more argument - custom name of a directory where the project should be pulled to, or `.` to pull the project into current directory (it must be empty to do so) 
- to add file to tracking, you can use `git add` command with argument being name or pattern of a file(s) to track, or `.` to start tracking of all files 
- `git status` - shows current branch we're on and status of working directory -> lists all files changed that might be added to staging & any untracked file that we might wanna start to track
- files/directories may be ignored by git by listing them in `.gitignore` file
    - blank lines and lines starting `#` are ignored
    - patterns ending with `/` specify directories
    - patterns starting `!` negates the logic
    - glob patterns are enabled (like `*` for all, etc.)

### Partial commits
It seems to be a good practice to commit changes grouped together by the logical parts rather than the whole bunch together - smaller commits in a particular order might "tell a story" of what happened

### Issue Resolution
When a commit resolves issue, commit message should contain information about what issue was resolved. Example: `Solved this serious problem - resolves #55`

### Licensing
choosealicense.com

### Stashing
When working on something and suddenly need to switch to another branch or keep current changes for later, `git stash` might be used to temporarily store changes on current branch and apply later.
`git stash` - stashes current changes for later apply
`git stash list` - list of stashed stuff
`git stash apply` - apply most recent stashed changes
`git stash apply stash@{0}` - apply changes from concrete stash

#### [back](./../readme.md)