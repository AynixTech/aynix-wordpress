<?php
/**
 * Template Name: AI Tools for Leadership
 * Template Post Type: page
 * Description: Página de herramientas de IA para líderes y ejecutivos
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="ai-tools-container">
			<!-- Language Selector -->
			<div class="language-selector">
				<form method="post" id="lang-form">
					<button type="submit" name="lang" value="es" class="lang-btn <?php echo (aynix_get_current_language() === 'es') ? 'active' : ''; ?>">📍 Español</button>
					<button type="submit" name="lang" value="en" class="lang-btn <?php echo (aynix_get_current_language() === 'en') ? 'active' : ''; ?>">🌍 English</button>
				</form>
			</div>

			<?php
			// Handle language change
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
				$lang = sanitize_text_field($_POST['lang']);
				if (in_array($lang, ['es', 'en', 'it', 'pt'])) {
					setcookie('site_lang', $lang, time() + (365 * 24 * 60 * 60), '/');
					wp_safe_remote_get(home_url()); // Refresh to apply new language
				}
			}
			?>

			<!-- Header Section -->
			<section class="ai-tools-header">
				<h1><?php echo aynix_translate('ai_tools.header.title'); ?></h1>
				<p class="subtitle"><?php echo aynix_translate('ai_tools.header.subtitle'); ?></p>
			</section>

			<!-- Intro Section -->
			<section class="ai-tools-intro">
				<div class="intro-box">
					<h2><?php echo aynix_translate('ai_tools.intro.title'); ?></h2>
					<p><?php echo aynix_translate('ai_tools.intro.text'); ?></p>
					<ul>
						<li>✓ Generar contenido visual profesional sin diseñador</li>
						<li>✓ Crear videos de comunicados en minutos, no en horas</li>
						<li>✓ Extraer insights clave de reportes de 50 páginas en segundos</li>
						<li>✓ Automatizar tareas repetitivas y enfocarte en estrategia</li>
					</ul>
				</div>
			</section>

			<!-- Tools by Category -->
			<div class="tools-grid">

				<!-- SECTION 1: IMAGE GENERATION -->
				<section class="tool-category" id="images">
					<div class="category-header">
						<h2><?php echo aynix_translate('ai_tools.section.images'); ?></h2>
						<p><?php echo aynix_translate('ai_tools.section.images_desc'); ?></p>
					</div>

					<div class="tools-list">
						<!-- DALL-E 3 -->
						<div class="tool-card">
							<div class="tool-logo">🎨</div>
							<h3>DALL·E 3</h3>
							<p class="tool-provider">OpenAI</p>
							<p class="tool-description">Generador de imágenes con IA. Ideal para crear visuals profesionales, portadas, gráficos personalizados.</p>
							<div class="tool-meta">
								<span class="skill-level">Principiante</span>
								<span class="price">Freemium</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Imágenes para reportes ejecutivos</li>
									<li>Assets para comunicados internos</li>
									<li>Portadas de presentaciones</li>
								</ul>
							</div>
							<a href="https://openai.com/dall-e-3" target="_blank" class="btn-tool">Ir a DALL·E 3</a>
						</div>

						<!-- Midjourney -->
						<div class="tool-card">
							<div class="tool-logo">🎭</div>
							<h3>Midjourney</h3>
							<p class="tool-provider">Midjourney Inc.</p>
							<p class="tool-description">Generador de imágenes artísticas y profesionales. Excelente para conceptos visuales únicos.</p>
							<div class="tool-meta">
								<span class="skill-level">Intermediario</span>
								<span class="price">$10-96/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Imágenes de campaña corporativa</li>
									<li>Conceptos visuales para nuevos proyectos</li>
									<li>Branding visual personalizado</li>
								</ul>
							</div>
							<a href="https://www.midjourney.com" target="_blank" class="btn-tool">Ir a Midjourney</a>
						</div>

						<!-- Ideogram -->
						<div class="tool-card">
							<div class="tool-logo">✨</div>
							<h3>Ideogram</h3>
							<p class="tool-provider">Ideogram Inc.</p>
							<p class="tool-description">Especializada en imágenes con texto legible. Perfecta para gráficos con mensajes incorporados.</p>
							<div class="tool-meta">
								<span class="skill-level">Principiante</span>
								<span class="price">Freemium</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Infografías con mensajes clave</li>
									<li>Social media visuals con texto</li>
									<li>Posters y comunicados visuales</li>
								</ul>
							</div>
							<a href="https://ideogram.ai" target="_blank" class="btn-tool">Ir a Ideogram</a>
						</div>
					</div>
				</section>

				<!-- SECTION 2: VIDEO GENERATION -->
				<section class="tool-category" id="videos">
					<div class="category-header">
						<h2>🎬 Generación de Videos</h2>
						<p>Crea videos de comunicación, onboarding y presentaciones sin necesidad de grabar o editar.</p>
					</div>

					<div class="tools-list">
						<!-- HeyGen -->
						<div class="tool-card">
							<div class="tool-logo">🎙️</div>
							<h3>HeyGen</h3>
							<p class="tool-provider">HeyGen Inc.</p>
							<p class="tool-description">Crea avatares de IA que hablan. El CEO puede grabar un mensaje una sola vez y traducirlo a múltiples idiomas.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">$25-320/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Mensajes del CEO sin necesidad de estar en cámara</li>
									<li>Videos en múltiples idiomas sin re-grabar</li>
									<li>Comunicados corporativos automatizados</li>
									<li>Onboarding de nuevos empleados</li>
								</ul>
							</div>
							<a href="https://www.heygen.com" target="_blank" class="btn-tool">Ir a HeyGen</a>
						</div>

						<!-- Synthesia -->
						<div class="tool-card">
							<div class="tool-logo">🎥</div>
							<h3>Synthesia</h3>
							<p class="tool-provider">Synthesia Ltd.</p>
							<p class="tool-description">Plataforma de video con IA para crear videos profesionales con avatares en 150+ idiomas.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">$30-264/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Comunicados ejecutivos globales</li>
									<li>Training videos corporativos</li>
									<li>Explicación de políticas en video</li>
									<li>Comunicación interna escalable</li>
								</ul>
							</div>
							<a href="https://www.synthesia.io" target="_blank" class="btn-tool">Ir a Synthesia</a>
						</div>

						<!-- Runway ML -->
						<div class="tool-card">
							<div class="tool-logo">🚀</div>
							<h3>Runway ML</h3>
							<p class="tool-provider">Runway</p>
							<p class="tool-description">Crea y edita videos generados por IA. Transforma texto en video, genera efectos y ediciones.</p>
							<div class="tool-meta">
								<span class="skill-level">Intermediario</span>
								<span class="price">Freemium - $12-55/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Resúmenes ejecutivos en video</li>
									<li>Videos de presentación automáticos</li>
									<li>Edición rápida de contenido</li>
									<li>Efectos profesionales sin editor</li>
								</ul>
							</div>
							<a href="https://runwayml.com" target="_blank" class="btn-tool">Ir a Runway ML</a>
						</div>

						<!-- Kling AI -->
						<div class="tool-card">
							<div class="tool-logo">🎞️</div>
							<h3>Kling AI</h3>
							<p class="tool-provider">Kuaishou</p>
							<p class="tool-description">Generador de video de texto a video con excelente calidad. Emergente y muy accesible.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">Freemium</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Videos de concepto rápidos</li>
									<li>Demostraciones de producto</li>
									<li>Contenido experimental ágil</li>
								</ul>
							</div>
							<a href="https://kling.kuaishou.com" target="_blank" class="btn-tool">Ir a Kling AI</a>
						</div>
					</div>
				</section>

				<!-- SECTION 3: SUMMARIZATION & ANALYSIS -->
				<section class="tool-category" id="summaries">
					<div class="category-header">
						<h2>📝 Resúmenes y Análisis de Documentos</h2>
						<p>Extrae insights clave de reportes largos, actas y documentos en segundos.</p>
					</div>

					<div class="tools-list">
						<!-- Claude -->
						<div class="tool-card">
							<div class="tool-logo">🧠</div>
							<h3>Claude</h3>
							<p class="tool-provider">Anthropic</p>
							<p class="tool-description">Modelo de IA versátil. Excelente para análisis, resumen y síntesis de información compleja.</p>
							<div class="tool-meta">
								<span class="skill-level">Intermedio-Avanzado</span>
								<span class="price">Freemium - $20/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Resumir reportes de 50+ páginas</li>
									<li>Extraer 5 puntos clave de documentos</li>
									<li>Análisis de datos y tendencias</li>
									<li>Redacción de emails y comunicados</li>
								</ul>
							</div>
							<a href="https://claude.ai" target="_blank" class="btn-tool">Ir a Claude</a>
						</div>

						<!-- ChatGPT -->
						<div class="tool-card">
							<div class="tool-logo">💬</div>
							<h3>ChatGPT</h3>
							<p class="tool-provider">OpenAI</p>
							<p class="tool-description">Modelo conversacional más popular. Versátil para múltiples tareas de análisis y escritura.</p>
							<div class="tool-meta">
								<span class="skill-level">Principiante-Intermedio</span>
								<span class="price">Freemium - $20/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Resumir actas de reuniones</li>
									<li>Redacción de comunicados</li>
									<li>Análisis rápido de propuestas</li>
									<li>Brainstorming y generación de ideas</li>
								</ul>
							</div>
							<a href="https://chatgpt.com" target="_blank" class="btn-tool">Ir a ChatGPT</a>
						</div>

						<!-- NotebookLM -->
						<div class="tool-card">
							<div class="tool-logo">📓</div>
							<h3>NotebookLM</h3>
							<p class="tool-provider">Google</p>
							<p class="tool-description">Sube documentos y haz preguntas sobre ellos. Crea podcast de audio sobre tu contenido.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">Freemium</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Q&A sobre documentos internos</li>
									<li>Generar podcast de reportes</li>
									<li>Crear notas ejecutivas automáticas</li>
									<li>Análisis comparativo de documentos</li>
								</ul>
							</div>
							<a href="https://notebooklm.google.com" target="_blank" class="btn-tool">Ir a NotebookLM</a>
						</div>

						<!-- Fathom (Meeting Recap) -->
						<div class="tool-card">
							<div class="tool-logo">📞</div>
							<h3>Fathom</h3>
							<p class="tool-provider">Fathom Inc.</p>
							<p class="tool-description">Registra y resume automáticamente reuniones en video. Extrae tareas, decisiones y puntos clave.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Freemium - $12/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Resúmenes automáticos de reuniones</li>
									<li>Extracción de tareas y responsables</li>
									<li>Actas de reunión generadas al instante</li>
									<li>Sincronización de equipos dispersos</li>
								</ul>
							</div>
							<a href="https://fathom.video" target="_blank" class="btn-tool">Ir a Fathom</a>
						</div>
					</div>
				</section>

				<!-- SECTION 4: COMPLEMENTARY TOOLS (NO AI) -->
				<section class="tool-category" id="complementary">
					<div class="category-header">
						<h2>🛠️ Herramientas Complementarias (No-IA)</h2>
						<p>Aplicaciones profesionales para diseño, presentaciones y manipulación de documentos.</p>
					</div>

					<div class="tools-list">
						<!-- CANVA -->
						<div class="tool-card">
							<div class="tool-logo">🎨</div>
							<h3>Canva</h3>
							<p class="tool-provider">Canva Inc.</p>
							<p class="tool-description">Plataforma de diseño intuitiva con miles de templates. Crea presentaciones, infografías, posts y más sin experiencia de diseño.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Freemium - $13/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Presentaciones ejecutivas profesionales</li>
									<li>Infografías y resúmenes visuales</li>
									<li>Posts para redes sociales</li>
									<li>Reportes visuales impactantes</li>
									<li>Comunicados internos con diseño</li>
								</ul>
							</div>
							<a href="https://www.canva.com" target="_blank" class="btn-tool">Ir a Canva</a>
						</div>

						<!-- Microsoft PowerPoint -->
						<div class="tool-card">
							<div class="tool-logo">📊</div>
							<h3>Microsoft PowerPoint</h3>
							<p class="tool-provider">Microsoft</p>
							<p class="tool-description">El estándar de presentaciones. Versáties online (PowerPoint Web) y desktop con IA integrada.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">Gratuito Web / Office 365 desde $7/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Presentaciones ejecutivas estándar</li>
									<li>Reportes financieros y operacionales</li>
									<li>Propuestas a clientes</li>
									<li>Presentaciones con colaboración en tiempo real</li>
									<li>Designer AI integrado para sugerencias</li>
								</ul>
							</div>
							<a href="https://www.office.com/" target="_blank" class="btn-tool">Ir a PowerPoint Online</a>
						</div>

						<!-- Google Slides -->
						<div class="tool-card">
							<div class="tool-logo">📈</div>
							<h3>Google Slides</h3>
							<p class="tool-provider">Google</p>
							<p class="tool-description">Alternativa colaborativa a PowerPoint. Gratuito, basado en la nube, acceso desde cualquier dispositivo.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Gratuito (Google cuenta)</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Presentaciones colaborativas en equipo</li>
									<li>Acceso desde cualquier dispositivo</li>
									<li>Integración con Google Workspace</li>
									<li>Sincronización automática</li>
									<li>Perfecto para equipos distribuidos</li>
								</ul>
							</div>
							<a href="https://docs.google.com/presentation" target="_blank" class="btn-tool">Ir a Google Slides</a>
						</div>

						<!-- Photopea -->
						<div class="tool-card">
							<div class="tool-logo">🖼️</div>
							<h3>Photopea</h3>
							<p class="tool-provider">Photopea</p>
							<p class="tool-description">Editor de imágenes online compatible con Photoshop. Abre y edita archivos PSD directamente en el navegador.</p>
							<div class="tool-meta">
								<span class="skill-level">Intermedio</span>
								<span class="price">Freemium - $10/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Editar imágenes generadas por IA</li>
									<li>Trabajar con archivos PSD sin Photoshop</li>
									<li>Ajustes profesionales de fotos</li>
									<li>Redimensionar y adaptar imágenes</li>
									<li>Ediciones rápidas sin software pesado</li>
								</ul>
							</div>
							<a href="https://www.photopea.com" target="_blank" class="btn-tool">Ir a Photopea</a>
						</div>

						<!-- Figma -->
						<div class="tool-card">
							<div class="tool-logo">✏️</div>
							<h3>Figma</h3>
							<p class="tool-provider">Figma Inc.</p>
							<p class="tool-description">Herramienta de diseño colaborativo. Ideal para crear prototipos, mockups y colaborar en tiempo real.</p>
							<div class="tool-meta">
								<span class="skill-level">Intermedio</span>
								<span class="price">Freemium - $12/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Diseño de presentaciones profesionales</li>
									<li>Mockups de ideas nuevas</li>
									<li>Colaboración de diseño con equipos</li>
									<li>Componentes reutilizables de marca</li>
									<li>Exportación directa a múltiples formatos</li>
								</ul>
							</div>
							<a href="https://www.figma.com" target="_blank" class="btn-tool">Ir a Figma</a>
						</div>

						<!-- Gamma App -->
						<div class="tool-card">
							<div class="tool-logo">✨</div>
							<h3>Gamma App</h3>
							<p class="tool-provider">Gamma Inc.</p>
							<p class="tool-description">Presenta tus ideas hermosas en segundos. Escribe tu idea y Gamma genera el diseño automáticamente.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Freemium - $15/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Presentaciones generadas automáticamente</li>
									<li>Documentos interactivos profesionales</li>
									<li>Presentaciones en formato web</li>
									<li>Menos tiempo de diseño, más contenido</li>
									<li>Ideal combinado con IA de texto</li>
								</ul>
							</div>
							<a href="https://gamma.app" target="_blank" class="btn-tool">Ir a Gamma App</a>
						</div>

						<!-- iLovePDF -->
						<div class="tool-card">
							<div class="tool-logo">📄</div>
							<h3>iLovePDF</h3>
							<p class="tool-provider">Antiun Ltd.</p>
							<p class="tool-description">Suite de herramientas para PDFs: mergiar, dividir, comprimir, convertir, editar sin software.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Freemium - $5.99/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Mergiar múltiples PDFs en uno</li>
									<li>Dividir PDF en páginas individuales</li>
									<li>Comprimir PDFs para envío por email</li>
									<li>Convertir imágenes a PDF</li>
									<li>Editar y añadir textos a PDFs</li>
									<li>Extraer imágenes de PDFs</li>
								</ul>
							</div>
							<a href="https://www.ilovepdf.com" target="_blank" class="btn-tool">Ir a iLovePDF</a>
						</div>

						<!-- Smallpdf -->
						<div class="tool-card">
							<div class="tool-logo">📋</div>
							<h3>Smallpdf</h3>
							<p class="tool-provider">Smallpdf AG</p>
							<p class="tool-description">Plataforma integral para trabajar con PDFs. Similar a iLovePDF con características adicionales.</p>
							<div class="tool-meta">
								<span class="skill-level">Muy Fácil</span>
								<span class="price">Freemium - $7.99/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Editar PDFs directamente online</li>
									<li>Fragmentar y reorganizar páginas</li>
									<li>Firmar PDFs digitalmente</li>
									<li>Reconocimiento OCR para escaneos</li>
									<li>Proteger PDFs con contraseña</li>
									<li>Convertir entre formatos</li>
								</ul>
							</div>
							<a href="https://smallpdf.com" target="_blank" class="btn-tool">Ir a Smallpdf</a>
						</div>

						<!-- Adobe Express -->
						<div class="tool-card">
							<div class="tool-logo">🎬</div>
							<h3>Adobe Express</h3>
							<p class="tool-provider">Adobe</p>
							<p class="tool-description">Herramienta rápida de Adobe para crear gráficos, videos cortos y posts. Más accesible que Creative Cloud.</p>
							<div class="tool-meta">
								<span class="skill-level">Fácil</span>
								<span class="price">Freemium - $4.99/mes</span>
							</div>
							<div class="tool-usecase">
								<strong>Caso de uso para líderes:</strong>
								<ul>
									<li>Edición rápida de imágenes</li>
									<li>Videos cortos para comunicación</li>
									<li>Gráficos con marca corporativa</li>
									<li>Posts para redes sociales</li>
									<li>Acceso a recursos Adobe de calidad</li>
								</ul>
							</div>
							<a href="https://www.adobe.com/express/" target="_blank" class="btn-tool">Ir a Adobe Express</a>
						</div>
					</div>
				</section>

				<!-- SECTION 5: COMBINED WORKFLOWS -->
				<section class="tool-category" id="workflows">
					<div class="category-header">
						<h2>🔁 Flujos Combinados: El Diferenciador Real</h2>
						<p>No uses herramientas sueltas. Encadénalas para crear un pipeline completo.</p>
					</div>

					<div class="workflow-examples">
						<div class="workflow-box">
							<h3>Pipeline 1: Comunicado Corporativo Multiidioma</h3>
							<div class="workflow-steps">
								<div class="step">
									<span class="step-num">1</span>
									<strong>Claude/ChatGPT</strong> genera el guion del mensaje (<100 palabras)
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">2</span>
									<strong>DALL·E o Ideogram</strong> crea una imagen relacionada
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">3</span>
									<strong>HeyGen o Synthesia</strong> genera el video con avatar en 5 idiomas
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">4</span>
									<strong>Resultado:</strong> Video profesional y multiidioma en 30 minutos
								</div>
							</div>
						</div>

						<div class="workflow-box">
							<h3>Pipeline 2: Reporte Ejecutivo a Contenido</h3>
							<div class="workflow-steps">
								<div class="step">
									<span class="step-num">1</span>
									<strong>NotebookLM o Claude</strong> resume reporte de 50 páginas
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">2</span>
									<strong>ChatGPT</strong> transforma resumen en 5 puntos clave con recomendaciones
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">3</span>
									<strong>Ideogram</strong> crea una infografía con los puntos principales
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">4</span>
									<strong>Resultado:</strong> Insight presentable en 10 minutos
								</div>
							</div>
						</div>

						<div class="workflow-box">
							<h3>Pipeline 3: Onboarding Automático</h3>
							<div class="workflow-steps">
								<div class="step">
									<span class="step-num">1</span>
									<strong>Claude/ChatGPT</strong> genera script de bienvenida personalizado
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">2</span>
									<strong>HeyGen</strong> crea video del CEO presentando la empresa
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">3</span>
									<strong>DALL·E</strong> genera imágenes de la oficina o equipo
								</div>
								<div class="step-arrow">↓</div>
								<div class="step">
									<span class="step-num">4</span>
									<strong>Resultado:</strong> Experiencia de onboarding escalable y profesional
								</div>
							</div>
						</div>
					</div>
				</section>

				<!-- SECTION 6: IMPORTANT CONSIDERATIONS -->
				<section class="tool-category" id="considerations">
					<div class="category-header">
						<h2>⚠️ Consideraciones Importantes para Líderes</h2>
						<p>Antes de usar estas herramientas, debes conocer estos riesgos y mejores prácticas.</p>
					</div>

					<div class="considerations-grid">
						<div class="consideration-card">
							<h3>🔒 Privacidad de Datos</h3>
							<p><strong>Regla de oro:</strong> Nunca subas información confidencial, datos de clientes, números financieros o secretos comerciales a herramientas públicas de IA.</p>
							<ul>
								<li>Para datos sensibles, usa versiones empresariales (Claude Pro, ChatGPT Enterprise)</li>
								<li>Lee la política de privacidad antes de usar cualquier herramienta</li>
								<li>Ten cuidado con información identificable de empleados</li>
							</ul>
						</div>

						<div class="consideration-card">
							<h3>✅ Verificación Humana</h3>
							<p><strong>Realidad:</strong> La IA comete errores. No todo lo que genera es 100% preciso.</p>
							<ul>
								<li>Revisa siempre el output antes de publicar</li>
								<li>Las herramientas de IA pueden alucinar datos o citas falsas</li>
								<li>Úsalo como borrador, no como producto final</li>
								<li>Para comunicados críticos, haz revisión legal/compliance</li>
							</ul>
						</div>

						<div class="consideration-card">
							<h3>⚖️ Derechos de Imagen y Propiedad Intelectual</h3>
							<p><strong>Legal:</strong> Entiende quién es dueño del contenido que generas.</p>
							<ul>
								<li>Herramientas tipo Freemium pueden usar tu contenido para entrenar</li>
								<li>Algunos generadores de imagen tienen limitaciones comerciales</li>
								<li>Usa licencias comerciales si vas a usar el contenido públicamente</li>
								<li>Para materiales corporativos críticos, opta por herramientas enterprise</li>
							</ul>
						</div>

						<div class="consideration-card">
							<h3>🎭 Autenticidad y Marca</h3>
							<p><strong>Cuidado:</strong> Usar avatares de IA puede afectar la confianza y autenticidad de tu marca.</p>
							<ul>
								<li>Disciérnelo claramente: "Este video fue creado con IA"</li>
								<li>Úsalo para tareas operativas, no para comunicados de crisis</li>
								<li>Los líderes seguirán necesitando aparecer en vivo en momentos críticos</li>
								<li>La IA es un complemento, no un reemplazo de la comunicación humana</li>
							</ul>
						</div>

						<div class="consideration-card">
							<h3>💼 Alineación con Cultura Corporativa</h3>
							<p><strong>Estrategia:</strong> Asegúrate de que el uso de IA esté alineado con tu cultura.</p>
							<ul>
								<li>Comunica al equipo por qué usas estas herramientas</li>
								<li>No reemplaces roles sin transición y capacitación</li>
								<li>Mantén humanos en el loop de decisiones importantes</li>
								<li>Considera el impacto emocional en tu equipo</li>
							</ul>
						</div>

						<div class="consideration-card">
							<h3>📊 Selección de Herramientas Adecuadas</h3>
							<p><strong>Recomendación:</strong> Elige según tu caso de uso y presupuesto.</p>
							<ul>
								<li>Gratuitas: Ideales para experimentar y aprender</li>
								<li>Freemium: Buen balance entre costo y funcionalidad</li>
								<li>Enterprise: Cuando manejo de datos sensibles es crítico</li>
								<li>Especializada: Para casos muy específicos (análisis legal, médico, etc.)</li>
							</ul>
						</div>
					</div>
				</section>

			</div>

			<!-- CTA Section -->
			<!-- CTA Section -->
			<section class="ai-tools-cta">
				<div class="cta-box">
					<h2><?php echo aynix_translate('ai_tools.cta.title'); ?></h2>
					<p><strong><?php echo aynix_translate('ai_tools.cta.text'); ?></strong></p>
					<p><?php echo aynix_translate('ai_tools.cta.next'); ?></p>
					<div class="cta-buttons">
						<a href="https://claude.ai" class="btn-primary">Empezar con Claude (Gratuito)</a>
						<a href="https://chatgpt.com" class="btn-primary">Empezar con ChatGPT (Gratuito)</a>
						<a href="https://ideogram.ai" class="btn-primary">Crear Imagen (Gratuito)</a>
					</div>
				</div>
			</section>

		</div>
	</main>
</div>

<style>
.ai-tools-container {
	max-width: 1200px;
	margin: 40px auto;
	padding: 20px;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

.ai-tools-header {
	text-align: center;
	margin-bottom: 60px;
	border-bottom: 3px solid #0066cc;
	padding-bottom: 30px;
}

.ai-tools-header h1 {
	font-size: 2.5em;
	margin: 0 0 15px 0;
	color: #1a1a1a;
}

.ai-tools-header .subtitle {
	font-size: 1.2em;
	color: #666;
	margin: 0;
	line-height: 1.6;
}

.ai-tools-intro {
	background: linear-gradient(135deg, #f0f4ff 0%, #e8f1ff 100%);
	padding: 30px;
	border-radius: 12px;
	margin-bottom: 60px;
	border-left: 5px solid #0066cc;
}

.intro-box h2 {
	margin-top: 0;
	color: #0066cc;
	font-size: 1.8em;
}

.intro-box ul {
	list-style: none;
	padding: 0;
	margin: 20px 0;
}

.intro-box li {
	padding: 10px 0;
	font-size: 1.1em;
	color: #333;
	line-height: 1.6;
}

.tools-grid {
	display: grid;
	grid-template-columns: 1fr;
	gap: 80px;
}

.tool-category {
	scroll-margin-top: 100px;
}

.category-header {
	margin-bottom: 40px;
	border-bottom: 2px solid #e0e0e0;
	padding-bottom: 20px;
}

.category-header h2 {
	font-size: 2em;
	margin: 0 0 15px 0;
	color: #1a1a1a;
}

.category-header p {
	font-size: 1.1em;
	color: #666;
	margin: 0;
}

.tools-list {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
	gap: 30px;
	margin-bottom: 50px;
}

.tool-card {
	background: white;
	border: 2px solid #e0e0e0;
	border-radius: 12px;
	padding: 25px;
	transition: all 0.3s ease;
	box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.tool-card:hover {
	border-color: #0066cc;
	box-shadow: 0 8px 20px rgba(0,102,204,0.15);
	transform: translateY(-5px);
}

.tool-logo {
	font-size: 3em;
	margin-bottom: 15px;
}

.tool-card h3 {
	font-size: 1.5em;
	margin: 0 0 5px 0;
	color: #1a1a1a;
}

.tool-provider {
	color: #0066cc;
	font-size: 0.9em;
	font-weight: 600;
	margin: 0 0 10px 0;
}

.tool-description {
	color: #666;
	font-size: 1em;
	line-height: 1.5;
	margin: 10px 0;
}

.tool-meta {
	display: flex;
	gap: 10px;
	margin: 15px 0;
	flex-wrap: wrap;
}

.skill-level, .price {
	background: #f0f0f0;
	padding: 5px 12px;
	border-radius: 20px;
	font-size: 0.85em;
	color: #666;
}

.tool-usecase {
	background: #f9f9f9;
	border-left: 3px solid #0066cc;
	padding: 12px 15px;
	margin: 15px 0;
	border-radius: 4px;
}

.tool-usecase strong {
	color: #0066cc;
}

.tool-usecase ul {
	margin: 10px 0 0 20px;
	padding: 0;
	list-style: disc;
}

.tool-usecase li {
	margin: 5px 0;
	color: #444;
	font-size: 0.95em;
}

.btn-tool {
	display: inline-block;
	background: #0066cc;
	color: white;
	padding: 10px 20px;
	border-radius: 6px;
	text-decoration: none;
	font-weight: 600;
	font-size: 0.95em;
	margin-top: 15px;
	transition: all 0.3s ease;
	border: 2px solid #0066cc;
}

.btn-tool:hover {
	background: white;
	color: #0066cc;
}

.workflow-examples {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
	gap: 30px;
}

.workflow-box {
	background: linear-gradient(135deg, #fff9f0 0%, #fff3e0 100%);
	border: 2px solid #ffb366;
	border-radius: 12px;
	padding: 25px;
}

.workflow-box h3 {
	color: #cc6600;
	margin-top: 0;
	font-size: 1.2em;
}

.workflow-steps {
	display: flex;
	flex-direction: column;
	gap: 8px;
}

.step {
	background: white;
	padding: 12px 15px;
	border-radius: 8px;
	display: flex;
	align-items: center;
	gap: 15px;
	font-size: 0.95em;
}

.step-num {
	background: #0066cc;
	color: white;
	width: 30px;
	height: 30px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	font-weight: bold;
	flex-shrink: 0;
}

.step-arrow {
	text-align: center;
	color: #cc6600;
	font-size: 1.5em;
	margin: 0;
}

.considerations-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 25px;
}

.consideration-card {
	background: white;
	border: 2px solid #e0e0e0;
	border-radius: 12px;
	padding: 20px;
}

.consideration-card h3 {
	color: #1a1a1a;
	margin-top: 0;
	font-size: 1.2em;
}

.consideration-card p {
	font-size: 0.95em;
	line-height: 1.6;
	color: #666;
}

.consideration-card ul {
	margin: 12px 0 0 20px;
	padding: 0;
	list-style: disc;
}

.consideration-card li {
	margin: 8px 0;
	color: #555;
	font-size: 0.9em;
}

.ai-tools-cta {
	background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
	color: white;
	padding: 50px;
	border-radius: 12px;
	text-align: center;
	margin-top: 60px;
}

.cta-box h2 {
	font-size: 2em;
	margin: 0 0 20px 0;
}

.cta-box p {
	font-size: 1.1em;
	margin: 10px 0;
	line-height: 1.6;
}

.cta-buttons {
	display: flex;
	gap: 15px;
	justify-content: center;
	flex-wrap: wrap;
	margin-top: 30px;
}

.btn-primary {
	display: inline-block;
	background: white;
	color: #0066cc;
	padding: 12px 25px;
	border-radius: 6px;
	text-decoration: none;
	font-weight: 600;
	transition: all 0.3s ease;
	border: 2px solid white;
}

.btn-primary:hover {
	background: transparent;
	color: white;
	border-color: white;
}

.language-selector {
	display: flex;
	gap: 10px;
	justify-content: flex-end;
	margin-bottom: 30px;
	flex-wrap: wrap;
}

.language-selector form {
	display: flex;
	gap: 10px;
	flex-wrap: wrap;
}

.lang-btn {
	background: #f0f0f0;
	border: 2px solid #ddd;
	padding: 8px 16px;
	border-radius: 6px;
	cursor: pointer;
	font-weight: 600;
	font-size: 0.9em;
	transition: all 0.3s ease;
}

.lang-btn:hover {
	background: #e0e0e0;
	border-color: #0066cc;
}

.lang-btn.active {
	background: #0066cc;
	color: white;
	border-color: #0066cc;
}

@media (max-width: 768px) {
	.language-selector {
		justify-content: center;
	}

	.ai-tools-header h1 {
		font-size: 1.8em;
	}

	.ai-tools-header .subtitle {
		font-size: 1em;
	}

	.tools-list {
		grid-template-columns: 1fr;
	}

	.category-header h2 {
		font-size: 1.5em;
	}

	.ai-tools-cta {
		padding: 30px 20px;
	}

	.cta-buttons {
		flex-direction: column;
	}

	.btn-primary {
		width: 100%;
		box-sizing: border-box;
	}
}
</style>

<?php get_footer(); ?>
