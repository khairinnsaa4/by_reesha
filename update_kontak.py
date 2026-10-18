import sys
import re

file_path = r'C:\xampp2\htdocs\by_reesha_laravel\resources\views\kontak.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Remove info-bar (starts with <div class="info-bar"> and ends with </div> closing the bar before <div class="content-grid">)
content = re.sub(r'<div class="info-bar">.*?</div>\s*</div>\s*<!-- MAIN CONTENT GRID -->', '<!-- MAIN CONTENT GRID -->', content, flags=re.DOTALL)

# 2. Update map address
content = content.replace(
    '<p>Jl. Tgk. Chik Ditiro, Gampong Pineung, Banda Aceh</p>',
    '<p>Muara Satu, Kota Lhokseumawe, Aceh 24353</p>'
)

# 3. Replace footer
old_footer = r'''    <!-- FOOTER -->
    <footer>
        &copy; {{ date('Y') }} By.Reesha — Custom Cake Banda Aceh. Hak Cipta Dilindungi.
    </footer>'''

new_footer = r'''    <!-- FOOTER INFO -->
    <footer style="background: #fafafa; border-top: 1px solid #eee; padding: 3rem 2rem 1.5rem; margin-top: 4rem;">
        <div style="max-width: 1160px; margin: auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 2rem; text-align: left;">
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Alamat Toko</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">Muara Satu, Kota Lhokseumawe,<br>Aceh 24353, Indonesia</p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Hubungi Kami</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">
                    <a href="https://wa.me/6282141519323" style="color: #666; text-decoration: none;">WA: +62 821-4151-9323</a><br>
                    <a href="mailto:byreesha.cake@gmail.com" style="color: #666; text-decoration: none;">Email: byreesha.cake@gmail.com</a>
                </p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Jam Operasional</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">Senin - Sabtu: 08.00 - 20.00 WIB<br>Minggu: 09.00 - 17.00 WIB</p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Sosial Media</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">
                    <a href="https://instagram.com/by.reesha" target="_blank" style="color: #c2185b; text-decoration: none; font-weight: 600;">Instagram: @by.reesha</a>
                </p>
            </div>
        </div>
        <div style="text-align: center; font-size: .75rem; color: #aaa; border-top: 1px solid #eee; padding-top: 1.5rem;">
            &copy; {{ date('Y') }} By.Reesha. Hak Cipta Dilindungi.
        </div>
    </footer>'''

content = content.replace(old_footer, new_footer)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("File updated successfully.")
