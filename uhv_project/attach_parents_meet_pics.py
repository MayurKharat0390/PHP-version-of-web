import os
import shutil
import django

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'uhv_project.settings')
django.setup()

from activities.models import Activity, ActivityImage
from django.core.files import File

# Activity ID for the Parents Workshop
ACTIVITY_ID = 13
SOURCE_FOLDER = r"D:\PROJECTS\UHV WEB\parents meet pics"
DEST_FOLDER = os.path.join("media", "activities", "gallery")

os.makedirs(DEST_FOLDER, exist_ok=True)

activity = Activity.objects.get(pk=ACTIVITY_ID)

# Clear any previously attached gallery images for this activity
existing = activity.images.all()
if existing.exists():
    print(f"Removing {existing.count()} existing gallery image(s)...")
    existing.delete()

# Collect all image files (skip duplicates like IMG_0861(1) if same size as IMG_0861)
seen_sizes = set()
image_files = []
for fname in sorted(os.listdir(SOURCE_FOLDER)):
    if fname.lower().endswith(('.jpg', '.jpeg', '.png', '.webp')):
        fpath = os.path.join(SOURCE_FOLDER, fname)
        fsize = os.path.getsize(fpath)
        if fsize in seen_sizes:
            print(f"  Skipping duplicate: {fname} ({fsize} bytes)")
            continue
        seen_sizes.add(fsize)
        image_files.append((fname, fpath))

print(f"\nAttaching {len(image_files)} photos to Activity: {activity.title}\n")

# Use the first non-duplicate image as the main activity cover image
first_fname, first_fpath = image_files[0]
dest_cover = os.path.join(DEST_FOLDER, first_fname)
shutil.copy2(first_fpath, dest_cover)
activity.image = os.path.join("activities", "gallery", first_fname).replace("\\", "/")
activity.save()
print(f"  Set cover image: {first_fname}")

# Attach all images as gallery entries
for i, (fname, fpath) in enumerate(image_files):
    dest_path = os.path.join(DEST_FOLDER, fname)
    shutil.copy2(fpath, dest_path)
    relative_path = os.path.join("activities", "gallery", fname).replace("\\", "/")

    img_obj = ActivityImage(
        activity=activity,
        caption=f"Parents Workshop – A Bond That Lasts Beyond Academics (Photo {i + 1})"
    )
    img_obj.image = relative_path
    img_obj.save()
    print(f"  [{i+1}/{len(image_files)}] Attached: {fname}")

print(f"\n✅ Done! {activity.images.count()} gallery images now linked to Activity ID {ACTIVITY_ID}.")
print(f"   View at: http://localhost:8080/activities/{ACTIVITY_ID}/")
