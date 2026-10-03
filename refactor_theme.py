import os
import glob

def refactor_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # The mapping of old hardcoded dark classes to new responsive classes
    replacements = {
        'bg-slate-900': 'bg-white dark:bg-slate-900',
        'bg-slate-950': 'bg-slate-50 dark:bg-slate-950',
        'bg-slate-800': 'bg-slate-100 dark:bg-slate-800',
        'border-slate-800': 'border-slate-200 dark:border-slate-800',
        'border-slate-700': 'border-slate-300 dark:border-slate-700',
        'text-slate-300': 'text-slate-600 dark:text-slate-300',
        'text-white': 'text-slate-900 dark:text-white',
        'text-slate-200': 'text-slate-700 dark:text-slate-200',
        'text-slate-400': 'text-slate-500 dark:text-slate-400',
    }

    # Only replace if the target class isn't already prefixed by dark:
    # A simple string replacement is fine as long as we haven't already run it.
    # To be safe, we first check if the file already has 'dark:bg-slate-900' etc.
    # We will do a simple replace, assuming this is the first pass for most of these.
    
    new_content = content
    for old, new in replacements.items():
        # Avoid double replacing if it's already there
        if new not in new_content:
            # We replace exact word boundaries where possible to avoid matching substrings
            # but since tailwind classes are space-separated, we can just replace the string.
            # However, we must be careful not to replace `text-white` inside `dark:text-white`.
            # Let's do a safer replace using regex
            import re
            # match the class name if it is NOT preceded by 'dark:'
            pattern = r'(?<!dark:)\b' + re.escape(old) + r'\b'
            new_content = re.sub(pattern, new, new_content)

    if new_content != content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Refactored: {filepath}")

# Paths to refactor
base_path = r"d:\websites\anmat.ly\resources\views"

for root, dirs, files in os.walk(base_path):
    for file in files:
        if file.endswith(".blade.php"):
            refactor_file(os.path.join(root, file))

print("Done refactoring theme classes.")
