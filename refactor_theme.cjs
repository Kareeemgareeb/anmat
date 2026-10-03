const fs = require('fs');
const path = require('path');

const replacements = {
    'bg-slate-900': 'bg-white dark:bg-slate-900',
    'bg-slate-950': 'bg-slate-50 dark:bg-slate-950',
    'bg-slate-800': 'bg-slate-100 dark:bg-slate-800',
    'border-slate-800': 'border-slate-200 dark:border-slate-800',
    'border-slate-700': 'border-slate-300 dark:border-slate-700',
    'text-slate-300': 'text-slate-600 dark:text-slate-300',
    'text-white': 'text-slate-900 dark:text-white',
    'text-slate-200': 'text-slate-700 dark:text-slate-200',
    'text-slate-400': 'text-slate-500 dark:text-slate-400'
};

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

function refactorFile(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    let newContent = content;

    for (const [oldClass, newClass] of Object.entries(replacements)) {
        if (!newContent.includes(newClass)) {
            // Regex to replace only if not preceded by 'dark:'
            // Note: JS regex doesn't support negative lookbehind in all old node versions, but Node 10+ does.
            const regex = new RegExp(`(?<!dark:)\\b${oldClass}\\b`, 'g');
            newContent = newContent.replace(regex, newClass);
        }
    }

    if (newContent !== content) {
        fs.writeFileSync(filePath, newContent, 'utf8');
        console.log(`Refactored: ${filePath}`);
    }
}

const basePath = path.join(__dirname, 'resources', 'views');
walkDir(basePath, refactorFile);
console.log('Done refactoring theme classes.');
